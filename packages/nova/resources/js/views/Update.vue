<template>
    <loading-view :loading="loading">
        <form v-if="panels" @submit.prevent="updateResource" autocomplete="off">
            <form-panel
                v-for="panel in panelsWithFields"
                @update-last-retrieved-at-timestamp="updateLastRetrievedAtTimestamp"
                :panel="panel"
                :name="panel.name"
                :key="panel.name"
                :resource-name="resourceName"
                :fields="panel.fields"
                mode="form"
                class="mb-6"
                :validation-errors="validationErrors"
                :via-resource="viaResource"
                :via-resource-id="viaResourceId"
                :via-relationship="viaRelationship"
            />

            <!-- Update Button -->
            <div class="flex items-center">
                <cancel-button />

                <progress-button
                    class="mr-3"
                    dusk="update-and-continue-editing-button"
                    @click.native="updateAndContinueEditing"
                    :disabled="isWorking"
                    :processing="submittedViaUpdateAndContinueEditing"
                >
                    {{ __('Update & Continue Editing') }}
                </progress-button>

                <progress-button
                    dusk="update-button"
                    type="submit"
                    :disabled="isWorking"
                    :processing="submittedViaUpdateResource"
                >
                    {{ __('Update :resource', { resource: singularName }) }}
                </progress-button>
            </div>
        </form>
    </loading-view>
</template>

<script>
import { Errors, InteractsWithResourceInformation } from 'laravel-nova'

export default {
    mixins: [InteractsWithResourceInformation],

    props: {
        resourceName: {
            type: String,
            required: true,
        },
        resourceId: {
            required: true,
        },
        viaResource: {
            default: '',
        },
        viaResourceId: {
            default: '',
        },
        viaRelationship: {
            default: '',
        },
    },

    data: () => ({
        relationResponse: null,
        loading: true,
        submittedViaUpdateAndContinueEditing: false,
        submittedViaUpdateResource: false,
        fields: [],
        panels: [],
        validationErrors: new Errors(),
        lastRetrievedAt: null,
    }),

    async created() {
        if (Nova.missingResource(this.resourceName)) return this.$router.push({ name: '404' })

        // If this update is via a relation index, then let's grab the field
        // and use the label for that as the one we use for the title and buttons
        if (this.isRelation) {
            const { data } = await Nova.request(
                `/nova-api/${this.viaResource}/field/${this.viaRelationship}`
            )
            this.relationResponse = data
        }

        this.getFields()
        this.updateLastRetrievedAtTimestamp()
    },

    methods: {
        /**
         * Get the available fields for the resource.
         */
        async getFields() {
            this.loading = true

            this.panels = []
            this.fields = []

            const {
                data: { panels, fields },
            } = await Nova.request()
                .get(`/nova-api/${this.resourceName}/${this.resourceId}/update-fields`, {
                    params: {
                        editing: true,
                        editMode: 'update',
                        viaResource: this.viaResource,
                        viaResourceId: this.viaResourceId,
                        viaRelationship: this.viaRelationship,
                    },
                })
                .catch(error => {
                    if (error.response.status == 404) {
                        this.$router.push({ name: '404' })
                        return
                    }
                })

            this.panels = panels
            this.fields = fields
            this.loading = false
        },

        /**
         * Update the resource using the provided data.
         */
        async updateResource() {
            this.submittedViaUpdateResource = true

            try {
                const {
                    data: { redirect },
                } = await this.updateRequest()

                this.submittedViaUpdateResource = false

                this.$toasted.show(
                    this.__('The :resource was updated!', {
                        resource: this.resourceInformation.singularLabel.toLowerCase(),
                    }),
                    { type: 'success' }
                )

                this.$router.push({ path: redirect })
            } catch (error) {
                this.submittedViaUpdateResource = false

                if (error.response.status == 422) {
                    this.validationErrors = new Errors(error.response.data.errors)
                }

                if (error.response.status == 409) {
                    this.$toasted.show(
                        this.__(
                            'Another user has updated this resource since this page was loaded. Please refresh the page and try again.'
                        ),
                        { type: 'error' }
                    )
                }
            }
        },

        /**
         * Update the resource and reset the form
         */
        async updateAndContinueEditing() {
            this.submittedViaUpdateAndContinueEditing = true

            try {
                const response = await this.updateRequest()

                this.submittedViaUpdateAndContinueEditing = false

                this.$toasted.show(
                    this.__('The :resource was updated!', {
                        resource: this.resourceInformation.singularLabel.toLowerCase(),
                    }),
                    { type: 'success' }
                )

                // Reset the form by refetching the fields
                this.getFields()

                this.validationErrors = new Errors()

                this.updateLastRetrievedAtTimestamp()
            } catch (error) {
                this.submittedViaUpdateAndContinueEditing = false

                if (error.response.status == 422) {
                    this.validationErrors = new Errors(error.response.data.errors)
                }

                if (error.response.status == 409) {
                    this.$toasted.show(
                        this.__(
                            'Another user has updated this resource since this page was loaded. Please refresh the page and try again.'
                        ),
                        { type: 'error' }
                    )
                }
            }
        },

        /**
         * Send an update request for this resource
         */
        updateRequest() {
            return Nova.request().post(
                `/nova-api/${this.resourceName}/${this.resourceId}`,
                this.updateResourceFormData,
                {
                    params: {
                        viaResource: this.viaResource,
                        viaResourceId: this.viaResourceId,
                        viaRelationship: this.viaRelationship,
                    },
                }
            )
        },

        /**
         * Update the last retrieved at timestamp to the current UNIX timestamp.
         */
        updateLastRetrievedAtTimestamp() {
            this.lastRetrievedAt = Math.floor(new Date().getTime() / 1000)
        },
    },

    computed: {
        /**
         * Create the form data for creating the resource.
         */
        updateResourceFormData() {
            return _.tap(new FormData(), formData => {
                _(this.fields).each(field => {
                    field.fill(formData)
                })

                formData.append('_method', 'PUT')
                formData.append('_retrieved_at', this.lastRetrievedAt)
            })
        },

        singularName() {
            if (this.relationResponse) {
                return this.relationResponse.singularLabel
            }

            return this.resourceInformation.singularLabel
        },

        isRelation() {
            return Boolean(this.viaResourceId && this.viaRelationship)
        },

        /**
         * Determine if the form is being processed
         */
        isWorking() {
            return this.submittedViaUpdateResource || this.submittedViaUpdateAndContinueEditing
        },

        panelsWithFields() {
            return _.map(this.panels, panel => {
                return {
                    name: panel.name,
                    fields: _.filter(this.fields, field => field.panel == panel.name),
                }
            })
        },
    },
}
</script>

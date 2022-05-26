<section role="footer">
	<div class="d-flex flex-row mt-2">
		<div class="col bg-green" style="height:3px">&nbsp;</div>
	</div>
	<ul class="list-group d-flex flex-row text-center text-green mt-4 align-items-stretch hovered">
		<li class="list-group-item border-0 col">
			<a href="tel:<?php echo e(Config('smpd.phone')); ?>">
				<h4 class="h-100 bd-green bd-radius-sm p-2">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0"><?php echo e(__('messages.phone')); ?></p>
						<p class="m-0"><?php echo e(Config('smpd.phone')); ?></p>
					</div>
				</h4>
			</a>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100 bd-green bd-radius-sm p-2">
				<a href="mailto:<?php echo e(Config('smpd.email')); ?>">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0"><?php echo e(__('messages.email')); ?></p>
						<p class="m-0"><?php echo e(Config('smpd.email')); ?></p>
					</div>
				</a>
			</h4>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100  bd-green bd-radius-sm p-2">
				<a href="maps://maps.google.com/?q=<?php echo e(Config('smpd.address')); ?>">
					<div class="d-flex flex-column justify-content-center h-100">
						<p class="font-weight-bold m-0"><?php echo e(__('messages.address')); ?></p>
						<p class="m-0"><?php echo e(Config('smpd.address')); ?></p>
					</div>
				</a>
			</h4>
		</li>
		<li class="list-group-item border-0 col">
			<h4 class="h-100 bd-green bd-radius-sm p-2">
				<div class="d-flex flex-column justify-content-center h-100">
					<p class="font-weight-bold m-0"><?php echo e(__('messages.working-time')); ?></p>
					<p class="m-0"><?php echo e(__('messages.working-time-values')); ?> <?php echo e(Config('smpd.working-time')); ?></p>
				</div>
			</h4>
		</li>
	</ul>
</section><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/partials/footer.blade.php ENDPATH**/ ?>
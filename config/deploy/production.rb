# в оригинальном файле capistran/laravel нужно убирать artisan --force и artisan optimize
# это почему-то мешает работать

server "server03", user: "ubuntu", roles: %w{app db web}

set :application, 'smpd'
set :repo_url, 'git@server01.smart2be.com:oleg/smpd.git'
set :branch, '1.0.1'

set :deploy_to, '/var/www/releases/releases.smpd.lv'
set :keep_releases, 3
set :linked_files, %w{app/Http/Kernel.php 
app/Http/Middleware/Authenticate.php
app/Http/Middleware/CheckForMaintenanceMode.php
app/Http/Middleware/EncryptCookies.php
app/Http/Middleware/RedirectIfAuthenticated.php
app/Http/Middleware/TrimStrings.php
app/Http/Middleware/TrustProxies.php
app/Http/Middleware/VerifyCsrfToken.php
app/Http/Controllers/Controller.php
}
set :linked_dirs, %w{bootstrap config public database vendor app/Console app/Exceptions app/Providers}
set :shared_dirs, %w{routes}

namespace :composer do
    desc "Runs composer."
    task :install do
        on roles(:all) do
            within release_path do
               execute "composer", "install", "--no-dev", "--no-interaction", "--prefer-dist"
            end
        end
    end
end

# нужно создать линк на routes и resources без этого не работает
namespace :laravel do
    task :route do
    	on roles(:all) do
            within release_path do
               execute "rm", "-rf", "../../shared/routes"
               execute "ln", "-s", "#{release_path}/routes", "../../shared/routes"
               execute "rm", "-rf", "../../shared/resources"
               execute "ln", "-s", "#{release_path}/resources", "../../shared/resources"
            end
        end
    end
end


namespace :laravel do
    desc "Laravel Artisan migrate."
    task :migrate do
        on roles(:all) do
            within release_path do
                execute "php", "artisan", "migrate"
            end
        end
    end
    desc "Cleans up the development files."
    task :cleanup do
        on roles(:all) do
            within release_path do
              
            end
        end
    end
end

# Запускаем composer, добавляем .env файл
# генерируем ключ и устанавливаем cache, почему-то без этого не заработало
namespace :deploy do
    after :publishing, "composer:install"
    after :finishing,  "laravel:cleanup"
    after :finishing,  "laravel:final"
end

namespace :laravel do
	# Для admin проблема в X-editable, нужна версия для bootstrap
	#
	desc 'Compiling assets'
	task :npm do
		on roles(:all) do
			execute "cd #{release_path}/ && npm install --silent"
			execute "cd #{release_path}/ && rm -rf X-editable"
			execute "cd #{release_path}/ && git clone git://github.com/Talv/x-editable.git X-editable"
			execute "cd #{release_path}/ && npm run prod --silent"
		end
	end
	desc 'Setting .env and regenerating keys'
	task :final do
		on roles(:all) do
			within release_path do
				execute "rm -rf #{release_path}/.env"
				execute "ln -s /var/www/releases/releases.smpd.lv/shared/.env #{release_path}/.env"
				execute "rm -rf #{release_path}/webpack.mix.js"
				execute "ln -s #{release_path}/webpack.prod.mix.js #{release_path}/webpack.mix.js"
				execute "php #{release_path}/artisan key:generate"
				execute "php #{release_path}/artisan config:cache"
				
			end
		end
	end
	#after :final, "laravel:npm"

end


# Здесь закидываем все стандартные laravel файлы на сервер, в основном в shared folder
namespace :ops do
  desc 'Copy non-git files to servers.'
  task :put_components do
    on roles(:app), in: :sequence, wait: 1 do
      execute "mkdir -p #{deploy_to}/shared"
      system("mkdir build")
      system("tar -zcf ./build/app.tar.gz ./app ./bootstrap ./config ./database ./public")
      upload! './build/app.tar.gz', "#{deploy_to}/shared", :recursive => true
      upload! '.env.production', "#{deploy_to}/shared/.env"
      execute "cd #{deploy_to}/shared
      tar -zxf app.tar.gz 
      rm -rf app.tar.gz
      mkdir -p routes
      mkdir -p resources"
      system("rm -rf build")
    end
  end
  after :put_components, "deploy"


end



cookbook_file "/etc/nginx/sites-available/default" do
  source "boxmeup_nginx.conf"
  owner "root"
  group "root"
  mode '0644'
  notifies :restart, resources(:service => "nginx")
end

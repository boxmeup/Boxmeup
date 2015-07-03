%w(
    php5-xdebug
    php5-mcrypt
    php5-intl
    php5-mysql
).each do |app|
  package app do
    action :install
  end
end

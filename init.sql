create database IF NOT EXISTS `tuts_rest`;
use tuts_rest; 
 
create table if not exists `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

insert ignore into users(name, email, password, status) values('admin', 'admin@lut.fi', 'admin', 'managing');

# Create Table with below command:
CREATE TABLE job_description (
    id int(11) NOT null AUTO_INCREMENT,
    title varchar(200) DEFAULT NULL,
    reports_to varchar(200) DEFAULT NULL,
    based_at varchar(200) DEFAULT NULL,
    job_purpose text,
    key_responsibilities text,
    scale_territory text,
    target_sectors text,
    created_date datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT charset=latin1;

#Change database credentials in config.php

#To check please use below sample string:
Title: Sample
Reports To: Sales Manager
Based at: Gurgaon Haryana
Job Purpose:
This is sample job purpose.
Scale and territory indicators:
Core product range of four ABC machines price range Rs.50 to Rs.250
Target Sectors: All major multiple-site organizations
Territory: US
Key responsibilities and accountabilities:
This is sample again.
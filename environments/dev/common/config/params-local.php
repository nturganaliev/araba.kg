<?php

$rootPath = realpath(dirname(__FILE__));
Yii::setAlias('@adv_upload_path', $rootPath . '/../../uploads/cars/');
Yii::setAlias('@adv_upload_url', '/../../uploads/cars/');
Yii::setAlias('@admin_url', 'http://test/'); //.araba.test
return [
];

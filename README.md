# Dynamic Binary Tree
This is a dynamic binary tree developed as demo using React JS and Laravel 9. This package has one API and React Frontend to view binary tree.

# How to configure
1) First thing we are going to create a mysql database with name "binarytree".
2) Than you need to run following commands in project directory to configure vendor and node modules.
   - npm install
   - composer install
3) Ok there we go... now you need to run migration to generate schema using following command:
   - php artisan migrate:fresh --seed
4) After migration under console you would be able to locate API_KEY is generated which is going to be used to access API.
5) After that you can run API using following command:
   - php artisan serve
6) Once API is live now you can move to react-front sub folder where you can find react project to configure and run with command below:
   - npm install
   - npm start (To run the project)
7) Now last step is under react-front folder there is a subfolder called config under which you can find config.js file this where you can set following things:
   - API Token
   - API Base URL


You can find postman collection under postman folder to see how this API works. Cheers!!!!

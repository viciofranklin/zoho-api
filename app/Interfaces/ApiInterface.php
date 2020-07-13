<?php

    namespace App\Interfaces;

    interface ApiInterface {

        public function getToken($code);

        public function refreshToken();

        public function getFields();

        public function getEntities();

        public function getEntity($id);

        public function createEntity($data);

        public function updateEntity($data);

        public function deleteEntity($id);
    }
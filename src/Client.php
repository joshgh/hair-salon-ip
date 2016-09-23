<?php
    class Client
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId()
        {
            $this->id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id =  {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->name = $new_name;
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client){
                $name = $client['name'];
                $id = $client['id'];
                $new_client = new Client($name, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach ($clients as $client){
                if ($client->getId() == $id){
                    $found_client = $client;
                }
            }
            return $found_client;
        }
    }
?>

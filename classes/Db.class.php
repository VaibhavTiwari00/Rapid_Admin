<?php

class Db
{

    // db connection
    private $db_link;

    // global db error
    private $error;

    // fetch all data erro 
    private $fetch_all_data_error;

    // fetch data error
    private $fetch_data_error;

    function __construct()
    {
        global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;
        $this->db_link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    }


    function __destruct()
    {
        if ($this->db_link) {
            mysqli_close($this->db_link);
        }
    }

    public function error()
    {
        return $this->error;
    }


    public function query($sql)
    {
        return mysqli_query($this->db_link, $sql);
    }

    public function fetch_all_data($sql)
    {

        // fire query in database
        $res = mysqli_query($this->db_link, $sql);

        //validate query response
        if ($res) {

            // no of count row get from query result
            $count = mysqli_num_rows($res);

            // check row count and process data 
            if ($count > 0) {

                $data = [];
                while ($a = mysqli_fetch_assoc($res)) {
                    array_push($data, $a);
                }

                // return process data 
                return  $data;
            } else {

                // set query fetch all data result error
                $this->fetch_all_data_error = 'No row record found';

                // return with false response
                return false;
            }
        } else {

            // return with false response
            return false;
        }
    }


    public function fetch_all_data_error()
    {
        return $this->fetch_all_data_error;
    }

    public function fetch_data($sql)

    {
        // fire query in database
        $res = mysqli_query($this->db_link, $sql);

        //validate query response
        if ($res) {

            // no of count row get from query result
            $count = mysqli_num_rows($res);

            // check row count and process data 
            if ($count > 0) {

                // return process data 
                return mysqli_fetch_assoc($res);
            } else {

                // set query fetch all data result error
                $this->fetch_data_error = 'No row record found';

                // return with false response
                return false;
            }
        } else {

            // return with false response
            return false;
        }
    }

    public function fetch_data_error()
    {
        return $this->fetch_data_error;
    }
}

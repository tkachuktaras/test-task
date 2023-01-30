<?php

class Survey_Model extends Model
{
    protected $table = 'survey';
    protected $answer_table = 'answer';
    protected $like_table = 'like';

    public function get_surveys($u_id = null){
         return $this->conn->query("
            SELECT $this->table.s_id, $this->table.u_id, s_title, s_status, created_at, GROUP_CONCAT($this->answer_table.a_text separator '¦') AS answers
            FROM $this->table
            LEFT JOIN $this->answer_table ON $this->table.s_id = $this->answer_table.s_id
            " . ($u_id ? "WHERE $this->table.u_id = '$u_id'": '') ."
            GROUP BY $this->table.s_id
        ");
    }

    public function get_survey($id = null){
        return $this->conn->query("
            SELECT s_id, s_title, s_status, created_at, GROUP_CONCAT(CONCAT(
                    a_id, '‖', a_text, '‖', COALESCE (users, '') 
                ) ORDER BY likes DESC separator '¦') as answers
            FROM (
                SELECT $this->table.s_id, $this->table.s_title, $this->table.s_status, 
                    $this->table.created_at, $this->answer_table.a_id, $this->answer_table.a_text, COUNT($this->like_table.u_id) as likes,
                    GROUP_CONCAT($this->like_table.u_id separator '˧') as users
                FROM $this->table
                LEFT JOIN $this->answer_table ON $this->table.s_id = $this->answer_table.s_id
                LEFT JOIN `$this->like_table` ON $this->answer_table.a_id = $this->like_table.a_id
                " . ($id ? "WHERE $this->table.s_id = '$id'": "WHERE $this->table.s_status = 'active'") . "
                GROUP BY $this->table.s_id, $this->answer_table.a_id
            ) $this->table GROUP BY $this->table.s_id
        ");
    }

    public function create($data){
        $time = date("Y-m-d H:i:s");
        $result_survery = $this->conn->query("
            INSERT INTO $this->table (`u_id`, `s_title`, `s_status`, `created_at`) 
            VALUES ('{$data['u_id']}', '{$data['s_title']}', '{$data['s_status']}', '{$time}')
        ");

        $survery_id = $this->conn->insert_id;
        $status = true;
        foreach($data['answers'] as $answer){
            $result = $this->conn->query("
                INSERT INTO $this->answer_table (`s_id`, `a_text`) 
                VALUES ('{$survery_id}', '{$answer}')
            ");

            if(!$result){
                $status = false;
            }
        }

        return ($result_survery && $status);
    }

    public function update($id, $data){
        $result_survery = $this->conn->query("
            UPDATE $this->table
            SET s_title='{$data['s_title']}', s_status='{$data['s_status']}'
            WHERE s_id='$id' 
        ");

        $this->delete_answers($id);

        $status = true;
        foreach($data['answers'] as $answer){
            $result = $this->conn->query("
                INSERT INTO $this->answer_table (`s_id`, `a_text`) 
                VALUES ('{$id}', '{$answer}')
            ");

            if(!$result){
                $status = false;
            }
        }

        return ($result_survery && $status);
    }

    public function delete_answers($id){
        $this->conn->query("
            DELETE FROM $this->answer_table
            WHERE s_id='$id'
        ");
    }

    public function delete($id){
        $this->conn->query("
            DELETE FROM $this->table
            WHERE s_id='$id'
        ");
    }

    public function like($id){
        $u_id = $_SESSION['u_id'];
        return $this->conn->query("
                INSERT INTO `$this->like_table` (`u_id`, `a_id`) 
                VALUES ('{$u_id}', '{$id}')
            ");
    }

    public function unlike($id){
        $u_id = $_SESSION['u_id'];
        return $this->conn->query("
            DELETE FROM `$this->like_table`
            WHERE a_id='$id' AND u_id='$u_id'
        ");
    }
}
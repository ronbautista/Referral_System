<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT fclt_password FROM facilities WHERE fclt_ref_id = ? OR fclt_contact = ?');


        if(!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            header("Location: ../facility-login.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("Location: ../facility-login.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["fclt_password"]);

        if($checkPwd == false)
        {
            $stmt = null;
            header("Location: ../facility-login.php?error=wrongpassword");
            exit();
        }
        else if($checkPwd == true)
        {
            $stmt = $this->connect()->prepare('SELECT * FROM facilities WHERE fclt_ref_id = ? OR fclt_contact = ? AND fclt_password = ?');

            if(!$stmt->execute(array($uid, $uid, $pwd))) {
                $stmt = null;
                header("Location: ../facility-login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("Location: ../facility-login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["facilityaccount"] = true;
            $_SESSION["fcltid"] = $user[0]["fclt_id"];
            $_SESSION["fcltname"] = $user[0]["fclt_name"];
            $_SESSION["fclttype"] = $user[0]["fclt_type"];

            $stmt = null;
        }

        $stmt = null;
    }
}
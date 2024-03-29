<?php
if(isset($_POST['pw-submit'])){
	require 'dbh.inc.php';
	$username = $_POST['username'];
	$current = $_POST['current-pw'];
	$pwNew = $_POST['new-pw'];
	$pwRepeat = $_POST['repeat-pw'];


	if (empty($current)) {
		header("Location: ../account.php?error=emptyfield&user=" . $username);
		session_start();
		$_SESSION['empty-field'] = TRUE;
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE user_name=?;";
    $stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror");
      exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($current, $row['user_pw']);
				if ($pwdCheck == false) {
					header("Location: ../account.php?error=invalidpassword&user=" . $username);
					//add session
					exit();
				} else if ($pwdCheck == true) {
					session_start();
					if (empty($pwNew) || empty($pwRepeat)) { //empty field check
						header("Location: ../account.php?error=emptyfields&user=" . $username);
						exit();
					} else if ($pwNew !== $pwRepeat) {
						header("Location: ../account.php?error=pwrepeat&user=" . $username);
						exit();
					} else { //end error pw repeat check handling
						//start update
						$sql = "UPDATE quiz.user SET user_pw=? WHERE user_name ='$username'";
						$stmt = mysqli_stmt_init($conn);

						//check connection
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo mysqli_error($conn);
						} else {
							$hashedPw = password_hash($pwNew, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "s", $hashedPw);
							mysqli_stmt_execute($stmt);
							header("Location: ../account.php?changepw=sucess&user=" . $username);
							exit();
						}


					} // end error handling
				} //end pw verification
			}
		}
	}

	mysqli_stmt_close($stmt);
  mysqli_close($conn);
} else {
	header("Location: ../account.php");
	exit();
}

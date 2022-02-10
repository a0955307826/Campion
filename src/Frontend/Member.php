<?php
include "../Lib/Member.php";

//顯示會員資訊
$str = getMemberName();
echo $str == "" ? '<a href="member_signIn.html"><img class="guest_icon" id="showMember" src="./images/common/memberIcon.svg" style="width: 25px; margin-right: 8px;"></a>' : '<a href="member.html"><img class="member_icons" id="showMember" src="./images/common/memberIconLoggedIn.svg" style="width: 25px; margin-right: 8px;"></a>';

?>
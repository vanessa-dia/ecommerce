<div id="dialog" title="Notice!">
    <p class="text-center"></p>
</div>
<? if($_SESSION['user']['permission'] == '1') require_once("admin.php"); else require_once("member.php")?>
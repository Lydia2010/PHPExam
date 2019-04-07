<?php require APPROOT . '/views/inc/header.php'; ?>
    <form method="post" action="<?php echo URLROOT; ?>/users/registerAjax" id="ajaxRegister">
        <input type="text" name="username" id="user" placeholder="username">
        <input type="password" name="password" id="pass" placeholder="password">
        <input type="submit" name="submit">
    </form>
    <hr>
    <h2>Users</h2>

    <div id="users"></div>

    <script>
        document.getElementById('ajaxRegister').addEventListener('submit', postName);


        function postName(e){
            e.preventDefault();

            let name = document.getElementById('user').value;
            let password=document.getElementById('pass').value;
            let params = "name="+name +"&password="+password+"&submit=submit";

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/shareposts/users/registerAjax', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                console.log(this.responseText);
            }

            xhr.send(params);
        }



    </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
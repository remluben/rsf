<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <?php if ($this->name) { ?>
        <p>Hello <?php echo $this->uppercase($this->escape($this->name)); ?>, my old friend.</p>
    <?php } else { ?>
        <p>Hello unknown guy.</p>
        <form action="" method="GET">
            Please provide yout name here: <input value="" name="name"/><br/>
            <input type="submit" value="okay"/>
        </form>
    <?php }?>
</body>
</html>
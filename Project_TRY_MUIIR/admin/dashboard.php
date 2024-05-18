<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    /* Set background color and font styles for the table */
    table {
        background-color: #CCCCCC;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 14px;
        width: 100%;
    }

    /* Set styles for table header cells */
    th {
        background-color: #2692AC;
        color: white;
        font-weight: bold;
        text-align: left;
        padding: 8px;
    }

    /* Set styles for table body cells */
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    /* Set styles for alternating rows */
    tr:nth-child(even) {
        background-color: #999999;
    }

    /* Set hover effect for rows */
    tr:hover {
        background-color: #ddd;
    }

    /* Set styles for action links */
    a.action {
        color: #4CAF50;
        text-decoration: none;
    }

    /* Set styles for delete links */
    a.delete {
        color: #f44336;
        text-decoration: none;
    }

    ul:hover {
        background-color: #000000;
    }

    .btn {
        background-color: #2692AC;
    }
    </style>
</head>

<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name"><a href="../index.php"><b>MUIIR</b></a>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <i class="fa fa-user" aria-hidden="true"></i>
    </header>
    <div class="body">

        <nav class="side-bar">
            <div class="user-p">
                <img src="../assets/images/user.jpeg">
                <h4>Admin</h4>
            </div>
            <ul>
                <li>
                    <a href="#" onclick="showSection('user')">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Users</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" onclick="showSection('copyright')">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Copyright</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('design')">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span>Design</span>
                    </a>
                </li> -->
                <li>
                    <a href="#" onclick="showSection('events')">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="showSection('affiliation')">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>Affiliation</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <section class="user" id="user" style="display:none;">
            <h2 style="text-align:center;"><b>Users</b></h2>
            <?php require_once "s1_users.php"; ?>
        </section>
        <section id="events" style="display:none;">
            <h2 style="text-align:center;"><b>Events</b></h2>
            <?php require_once "s4_events.php"; ?>
        </section>

        <section id="affiliation" style="display:none;">
            <h2 style="text-align:center;"><b>Affiliation</b></h2>
            <?php require_once "s5_affiliation.php"; ?>
        </section>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    function showSection(sectionId) {
        $('section').hide();
        $('#' + sectionId).show();
    }
    // get all the table elements in the dashboard
    const tables = document.querySelectorAll('.dashboard__section table');

    // loop through each table and set the width of its corresponding header
    tables.forEach((table, index) => {
        const header = document.querySelectorAll('.dashboard__section__header')[index];
        header.style.width = `${table.offsetWidth}px`;
    });
    </script>
</body>

</html>
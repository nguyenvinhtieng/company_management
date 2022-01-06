<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Programing & Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <script defer src="../main.js"></script>
</head>

<body>
    <div class="layout-container">
        <header class="header">
            <div class="header-container">
                <div class="header-logo">
                    <img src="../images/logo.png" alt="">
                </div>
                <input type="checkbox" id="toggle-menu" class="none">
                <label for="toggle-menu" class="toggle-menu none mobile">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
                        class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                        </path>
                    </svg>
                </label>
                <label for="toggle-menu" class="backdrop none"></label>
                <ul class="header-menu">
                    <label for="toggle-menu" class="close-modal none mobile">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                            class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg>
                    </label>
                    <li class="menu-items  active-menu">
                        <a href="#!" class="menu-link">Task</a>
                    </li>
                    <li class="menu-items">
                        <a href="#!" class="menu-link">My application</a>
                    </li>
                    <li class="menu-items">
                        <a href="#!" class="menu-link">My information</a>
                    </li>
                    <li class="menu-items none mobile">
                        <a class="menu-link" data-bs-toggle="modal" data-bs-target="#modal-change-password"
                            href="#!">Change password</a>
                    </li>
                    <li class="menu-items none mobile logout">
                        <a href="../logout.php" class="menu-link">Logout</a>
                    </li>
                    <li class="large-screen">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modal-change-password" href="#">Change password</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <!-- modal change password -->
        <div class="modal fade" id="modal-change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change password account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Current password</label>
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                                    class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                                    </path>
                                </svg>
                                <input type="text" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="">New password</label>
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                                    class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                                    </path>
                                </svg>
                                <input type="text" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="">Confirm password</label>
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock"
                                    class="svg-inline--fa fa-lock fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor"
                                        d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                                    </path>
                                </svg>
                                <input type="text" name="username" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Change</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- // content page -->

        <section class="task">
            <div class="task-detail">
                <h3>Task detail</h3>
                <div class="form-group">
                    <label for="">title</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">description</label>
                    <textarea type="text" value="" disabled>he thogn quan ly nha xe</textarea>
                </div>
                <div class="form-group">
                    <label for="">Employee id</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">Employee name</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">Deadline</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">Result</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">Is late</label>
                    <input type="text" value="he thogn quan ly nha xe" disabled>
                </div>
                <div class="form-group">
                    <label for="">File attachment</label>
                    <a href="#!">file</a>
                </div>
                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                    data-bs-target="#modal-submit-task">
                    Submit
                </button>
                <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal"
                    data-bs-target="#modal-receive-task">
                    Receive
                </button>
            </div>
            <div class="task-history">
                <h4>Task History</h4>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
                <div class="task-item">
                    <strong class="title">Lorem ipsum dolor sit amet.</strong>
                    <div class="file">File attackment</div>
                    <div class="time">12/12/1221</div>
                    <div class="type">wait</div>
                </div>
            </div>
        </section>

        <!-- modal submit task  -->
        <div class="modal fade" id="modal-submit-task" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">content</label>
                                <textarea name="" id=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">file attachment</label>
                                <input type="file">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal receive task -->
        <div class="modal fade" id="modal-receive-task" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Receive task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to receive this task?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Receive</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
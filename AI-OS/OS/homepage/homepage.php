<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Montserrat Font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/homepage.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="bg-grey">

    <div class="desktop-container d-flex justify-content-between">

        <!-- Left Side Icons -->
        <div class="icons">
            <div class="icon-item text-center">
                <img src="https://img.icons8.com/fluency/48/recycle-bin.png" class="desktop-icon" alt="Recycle Bin">
                <p>Recycle Bin</p>
            </div>
            <div class="icon-item text-center" onclick="openApp('AI Folders')">
                <img src="https://img.icons8.com/fluency/48/folder-invoices.png" class="desktop-icon" alt="AI Folders">
                <p>AI Folders</p>
            </div>
            <div class="icon-item text-center" onclick="openApp('Website Builder')">
                <img src="https://img.icons8.com/fluency/48/brain.png" class="desktop-icon" alt="AI Folders">
                <p>Website Builder</p>
            </div>
            <div class="icon-item text-center" onclick="openApp('AI LINKS')">
                <img src="https://img.icons8.com/fluency/48/artificial-intelligence.png" class="desktop-icon" alt="AI Folders">
                <p>AI LINKS</p>
            </div>
            <div class="icon-item text-center" onclick="openApp('Notes')">
                <img src="https://img.icons8.com/fluency/48/note.png" class="desktop-icon" alt="Notes">
                <p>Notes</p>
            </div>
            <div class="icon-item text-center" onclick="openApp('Games')">
                <img src="https://img.icons8.com/fluency/48/joystick.png" class="desktop-icon" alt="Games">
                <p>Games</p>
            </div>

        </div>


        <!-- Fake Terminal -->
        <div class="fake-terminal">
            <div class="terminal-header">Terminal</div>
            <div class="terminal-body" id="terminalBody">
                <!-- This is where past commands will be rendered -->
                <div id="terminalOutput">
                    <p><span class="text-green">Welcome to the AI Desktop!</span></p>
                    <p><span class="text-grey">Type 'help' for available commands...</span></p>
                </div>

                <!-- Persistent input line at bottom -->
                <div class="terminal-line">
                    <span class="terminal-prompt">
                <span class="text-red">user</span><span class="text-grey">@</span><span class="text-green">ubuntu</span><span class="text-grey">:~$</span>
                    </span>
                    <input type="text" id="terminalInput" class="terminal-input" autofocus />
                </div>
            </div>
        </div>






    </div>

    <!-- Bottom Taskbar -->
    <div class="taskbar d-flex align-items-center justify-content-between p-3">
        <!-- Start Button inside Taskbar -->
        <!-- Start Button inside Taskbar -->
        <div class="start-button" onclick="toggleStartMenu()">
            <div class="start-icon"></div>
            <span class="start-text">Start</span>
        </div>


        <!-- Start Menu -->
        <div id="startMenu" class="start-menu">
            <ul>
                <li onclick="openApp('AI Folders')">
                    <i class="fas fa-folder-open"></i> <span>AI Folders</span>
                </li>
                <li onclick="openApp('Website Builder')">
                    <i class="fas fa-cogs"></i> <span>Website Builder</span>
                </li>
                <li onclick="openApp('AI LINKS')">
                    <i class="fas fa-cogs"></i> <span>AI LINKS</span>
                </li>
                <li onclick="openApp('Recycle Bin')">
                    <i class="fas fa-trash-alt"></i> <span>Recycle Bin</span>
                </li>
                <li onclick="openApp('Settings')">
                    <i class="fas fa-cogs"></i> <span>Settings</span>
                </li>
                <li onclick="openApp('Power Off')">
                    <i class="fas fa-power-off"></i> <span>Power Off</span>
                </li>
            </ul>
        </div>




        <div class="app-button text-center">
            AI
        </div>
    </div>


    <!-- AI Folders Modal -->
    <div class="modal fade" id="aiFoldersModal" tabindex="-1" aria-labelledby="aiFoldersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" id="aiFoldersModalDialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="aiFoldersModalLabel">
                    <i class="fas fa-folder-open me-2 text-warning"></i>AI Folders
                </h5>
                    <div class="window-controls">
                        <button class="window-btn window-minimize" title="Minimize">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="window-btn window-maximize" title="Maximize" id="maximizeFoldersBtn">
                            <i class="fas fa-square"></i>
                        </button>
                        <button class="window-btn window-close" title="Close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- File Items -->
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/fluency/48/file.png" class="img-fluid mb-2" alt="File">
                            <div class="small text-light">report.docx</div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/fluency/48/pdf.png" class="img-fluid mb-2" alt="File">
                            <div class="small text-light">ebook.pdf</div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/fluency/48/image.png" class="img-fluid mb-2" alt="File">
                            <div class="small text-light">vacation.jpg</div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/fluency/48/code-file.png" class="img-fluid mb-2" alt="File">
                            <div class="small text-light">script.js</div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/fluency/48/ppt.png" class="img-fluid mb-2" alt="File">
                            <div class="small text-light">presentation.pptx</div>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3 text-center">
                            <img src="https://img.icons8.com/color/48/microsoft-excel-2019.png" class="img-fluid mb-2" alt="Excel">
                            <div class="small text-light">data.xlsx</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI LINKS Modal -->
    <div class="modal fade" id="aiLinksModal" tabindex="-1" aria-labelledby="aiLinksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" id="aiLinksModalDialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="aiLinksModalLabel">
          <i class="fas fa-link me-2 text-info"></i>AI LINKS
        </h5>
                    <div class="window-controls">
                        <button class="window-btn window-minimize" title="Minimize">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="window-btn window-maximize" title="Maximize" id="maximizeLinksBtn">
                            <i class="fas fa-square"></i>
                        </button>
                        <button class="window-btn window-close" title="Close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-body">
                    <!-- Categories -->
                    <div class="mb-3">
                        <h5 class="text-primary">Chatbots</h5>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <a href="https://chat.openai.com" target="_blank" class="text-decoration-none text-light hover-underline d-inline-block">
                                    <i class="fas fa-robot me-2"></i> ChatGPT
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <a href="https://bard.google.com" target="_blank" class="text-decoration-none text-light hover-underline d-inline-block">
                                    <i class="fas fa-comments me-2"></i> Google Bard
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-warning">Creative AI</h5>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <a href="https://www.midjourney.com" target="_blank" class="text-decoration-none text-light hover-underline d-inline-block">
                                    <i class="fas fa-palette me-2"></i> MidJourney
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-success">AI Music Tools</h5>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <a href="https://www.aiva.ai" target="_blank" class="text-decoration-none text-light hover-underline d-inline-block">
                                    <i class="fas fa-music me-2"></i> Aiva
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Notes List Modal -->
    <div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" id="notesModalDialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="notesModalLabel">
                    <i class="fas fa-sticky-note me-2 text-primary"></i>Notes
                </h5>
                    <div class="window-controls">
                        <button class="window-btn window-minimize" title="Minimize">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="window-btn window-maximize" title="Maximize" id="maximizeNotesBtn">
                            <i class="fas fa-square"></i>
                        </button>
                        <button class="window-btn window-close" title="Close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- NOTEPAD LIST -->
                <div class="modal-body bg-dark text-white rounded p-3">
                    <div class="mb-4">
                        <h5 class="mb-3">📝 Your Notepads</h5>
                        <ul id="notepadList" class="list-group list-group-flush">
                            <!-- List items populated by JS -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notepad Viewer Modal -->
    <div class="modal fade" id="notepadModal" tabindex="-1" aria-labelledby="notepadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="notepadModalLabel">
                    <i class="fas fa-sticky-note me-2 text-primary"></i><span id="notepadTitle">Notepad</span>
                </h5>
                    <div class="window-controls">
                        <button class="window-btn window-minimize" title="Minimize">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="window-btn window-maximize" title="Maximize" id="maximizeNotepadBtn">
                            <i class="fas fa-square"></i>
                        </button>
                        <button class="window-btn window-close" title="Close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="modal-body bg-dark text-white rounded p-3">
                    <div class="mb-3">
                        <textarea id="notepadContent" class="form-control bg-dark text-white border-secondary" rows="15"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-success" onclick="saveNote()">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                        <button class="btn btn-secondary" onclick="clearNote()">
                            <i class="fas fa-eraser me-1"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Games Modal -->
<div class="modal fade" id="gamesModal" tabindex="-1" aria-labelledby="gamesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" id="gamesModalDialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="gamesModalLabel">
                    <i class="fas fa-gamepad me-2 text-warning"></i>Games
                </h5>
                <div class="window-controls">
                    <button class="window-btn window-minimize" title="Minimize">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="window-btn window-maximize" title="Maximize" id="maximizeGamesBtn">
                        <i class="fas fa-square"></i>
                    </button>
                    <button class="window-btn window-close" title="Close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <!-- 2048 Game -->
                    <div class="col-6 col-sm-4 col-md-3 text-center" onclick="openGame('2048')">
                        <img src="../assets/images/icons/2048.png" class="img-fluid mb-2" alt="2048">
                        <div class="small text-light">2048</div>
                    </div>

                    <!-- Sudoku Game -->
                    <div class="col-6 col-sm-4 col-md-3 text-center" onclick="openGame('Sudoku')">
                        <img src="../assets/images/icons/sudoku.png" class="img-fluid mb-2" alt="Sudoku">
                        <div class="small text-light">Sudoku</div>
                    </div>

                    <!-- Tic Tac Toe Game -->
                    <div class="col-6 col-sm-4 col-md-3 text-center" onclick="openGame('Tic Tac Toe')">
                        <img src="../assets/images/icons/tic-tac-toe.png" class="img-fluid mb-2" alt="Tic Tac Toe">
                        <div class="small text-light">Tic Tac Toe</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









<ul id="customContextMenu" class="context-menu">
    <li onclick="hardReload()">
        <i class="fas fa-sync-alt me-2"></i> Refresh
    </li>
</ul>



    <!-- Bootstrap JS Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/homepage.js"></script>
</body>

</html>
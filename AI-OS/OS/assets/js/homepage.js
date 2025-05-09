// homepage.js

// Toggle the Start Menu
function toggleStartMenu() {
    const menu = document.getElementById('startMenu');
    menu.classList.toggle('open');
}

// Close the Start Menu when clicked outside
document.addEventListener('click', function (event) {
    const menu = document.getElementById('startMenu');
    const button = document.querySelector('.start-button');
    
    // Close the menu if the click is outside of the start button or the menu
    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.remove('open');
    }
});

// Simulate opening an app or page when an item is clicked in the menu
function openApp(appName) {
    if (appName === 'AI Folders') {
        const modal = new bootstrap.Modal(document.getElementById('aiFoldersModal'));
        modal.show();
    }
    else if (appName === "AI LINKS") {
        var modal = new bootstrap.Modal(document.getElementById('aiLinksModal'));
        modal.show();
    }
    else if (appName === 'Notes') {
        var modal = new bootstrap.Modal(document.getElementById('notesModal'));
        modal.show();
    }
     else if (appName === 'Recycle Bin') {
        alert('Recycle Bin opened');
    } else if (appName === 'Settings') {
        alert('Settings opened');
    } else if (appName === 'Power Off') {
        alert('Shutting down...');
    }
}

function toggleModalMaximization(modalId, buttonId) {
    const modalDialog = document.getElementById(modalId);
    const maximizeButton = document.getElementById(buttonId);

    if (modalDialog && maximizeButton) {
        maximizeButton.addEventListener('click', function () {
            // Toggle the maximized state for the modal dialog
            modalDialog.classList.toggle('modal-lg-custom'); // Add or remove custom class for maximization

            // Change the icon based on the state
            const icon = this.querySelector('i');
            if (modalDialog.classList.contains('modal-lg-custom')) {
                icon.classList.remove('fa-square');
                icon.classList.add('fa-window-restore');
            } else {
                icon.classList.remove('fa-window-restore');
                icon.classList.add('fa-square');
            }
        });
    } else {
        console.error(`Modal or Button with IDs ${modalId} or ${buttonId} not found.`);
    }
}





// Call the function for AI Folders Modal
toggleModalMaximization('aiFoldersModalDialog', 'maximizeFoldersBtn');

// Call the function for AI Links Modal
toggleModalMaximization('aiLinksModalDialog', 'maximizeLinksBtn');

// Call the function for Notes Modal
toggleModalMaximization('notesModalDialog', 'maximizeNotesBtn');

// Call the function for Notes viewer Modal
toggleModalMaximization('notepadModalDialog', 'maximizeNotepadBtn');

document.addEventListener('DOMContentLoaded', function () {
    const terminalInput = document.getElementById('terminalInput');
    const terminalOutput = document.getElementById('terminalOutput');
    const terminalBody = document.getElementById('terminalBody');

    const commands = [];

    function renderTerminal() {
        terminalOutput.innerHTML = `
            <p><span class="text-green">Welcome to the AI Desktop!</span></p>
            <p><span class="text-grey">Type 'help' for available commands...</span></p>
        `;

        commands.forEach(entry => {
            const cmd = document.createElement('p');
            cmd.innerHTML = `
                <span class="terminal-prompt">
                    <span class="text-red">user</span><span class="text-grey">@</span><span class="text-green">ubuntu</span><span class="text-grey">:~$</span>
                </span> ${entry.command}
            `;
            terminalOutput.appendChild(cmd);

            if (entry.response) {
                const res = document.createElement('p');
                res.innerHTML = `<span class='text-grey'>${entry.response}</span>`;
                terminalOutput.appendChild(res);
            }
        });

        terminalBody.scrollTop = terminalBody.scrollHeight;
    }

    terminalInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            const command = terminalInput.value.trim();
            if (!command) return;

            let response = '';

            switch (command.toLowerCase()) {
                case 'help':
                    response = 'Available commands: help, clear';
                    break;
                case 'clear':
                    commands.length = 0;
                    renderTerminal();
                    terminalInput.value = '';
                    return;
                case 'open notepad':
                    const notesModal1 = new bootstrap.Modal(document.getElementById('notesModal'));
                    notesModal1.show();
                    response = 'Opening Notes...';
                    break;    
                case 'open note':
                    const notesModal2 = new bootstrap.Modal(document.getElementById('notesModal'));
                    notesModal2.show();
                    response = 'Opening Notes...';
                    break;
                case 'open notes':
                    const notesModal3 = new bootstrap.Modal(document.getElementById('notesModal'));
                    notesModal3.show();
                    response = 'Opening Notes...';
                    break;
                default:
                    response = `Command not recognized: ${command}`;
            }

            commands.push({ command, response });
            renderTerminal();
            terminalInput.value = '';
        }
    });
});


function renderTerminal() {
    const output = document.getElementById('terminalOutput');
    output.innerHTML = `
        <p><span class="text-green">Welcome to the AI Desktop!</span></p>
        <p><span class="text-grey">Type 'help' for available commands...</span></p>
    `;

    commands.forEach(entry => {
        const cmd = document.createElement('p');
        cmd.innerHTML = `
            <span class="terminal-prompt">
                <span class="text-red">user</span><span class="text-grey">@</span><span class="text-green">ubuntu</span><span class="text-grey">:~$</span>
            </span> ${entry.command}
        `;
        output.appendChild(cmd);

        if (entry.response) {
            const res = document.createElement('p');
            res.innerHTML = `<span class='text-grey'>${entry.response}</span>`;
            output.appendChild(res);
        }
    });

    const terminalBody = document.getElementById('terminalBody');
    terminalBody.scrollTop = terminalBody.scrollHeight;
}




// notepad functionality start

// Load notepad list on page load
window.onload = function () {
    generateNotepadList();
};

// Fetch list of notepads
function generateNotepadList() {
    $.ajax({
        url: '/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/getNotepadList.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            const notepadList = $('#notepadList');
            notepadList.empty();

            if (Array.isArray(data)) {
                data.forEach(saveName => {
                    const listItem = $('<li>')
                        .addClass('list-group-item notepad-item mb-2 rounded')
                        .text(saveName)
                        .click(() => openNotepad(saveName));

                    notepadList.append(listItem);
                });
            } else {
                notepadList.append('<li class="text-muted">No notepads found.</li>');
            }
        },
        error: function () {
            alert('Failed to load notepads.');
        }
    });
}

function openNotepad(saveName) {
    $.ajax({
        url: '/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/readNotepad.php',
        method: 'GET',
        data: { save_name: saveName },
        dataType: 'json',
        success: function (data) {
            if (data.message) {
                alert(data.message);
            } else {
                $('#notepadTitle').text(data.save_name);
                $('#notepadContent').val(data.notes); // <-- Updated from data.content to data.notes
                $('#notepadModal').modal('show');
            }
        },
        error: function () {
            alert('Error loading note.');
        }
    });
}


// Save note (POST to your PHP endpoint)
function saveNote() {
    const saveName = $('#notepadTitle').text();
    const content = $('#notepadContent').val();

    $.ajax({
        url: '/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/saveNotepad.php', // Adjust path
        method: 'POST',
        data: { save_name: saveName, content: content },
        success: function () {
            alert('Note saved!');
        },
        error: function () {
            alert('Save failed.');
        }
    });
}

// Clear the note content
function clearNote() {
    $('#notepadContent').val('');
}


// notepad functionality end

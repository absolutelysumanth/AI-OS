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

// Function to toggle modal maximization
function toggleModalMaximization(modalId, buttonId) {
    const modalDialog = document.getElementById(modalId);
    const maximizeButton = document.getElementById(buttonId);
    
    maximizeButton.addEventListener('click', function () {
        modalDialog.classList.toggle('modal-lg-custom'); // Toggle maximized class
        
        // Change maximize icon to restore icon when maximized
        const icon = this.querySelector('i');
        if (modalDialog.classList.contains('modal-lg-custom')) {
            icon.classList.remove('fa-square');
            icon.classList.add('fa-window-restore');
        } else {
            icon.classList.remove('fa-window-restore');
            icon.classList.add('fa-square');
        }
    });

    
}

// Function to load the list of notepads from the server (API)
function loadNotepadList() {
    fetch('http://localhost/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/getNotepadList.php')
        .then(response => response.json())
        .then(data => {
            const notepadList = document.getElementById('notepadList');
            notepadList.innerHTML = ''; // Clear existing list items

            if (Array.isArray(data) && data.length > 0) {
                data.forEach(notepad => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = notepad;
                    listItem.onclick = () => loadNotepadContent(notepad); // Attach click handler
                    notepadList.appendChild(listItem);
                });
            } else {
                notepadList.innerHTML = '<li class="list-group-item">No notepads found</li>';
            }
        })
        .catch(error => console.error('Error loading notepads:', error));
}

// Function to load the content of a selected notepad using AJAX (jQuery)
function loadNotepadContent(notepadName) {
    $.ajax({
        url: `http://localhost/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/readNotepad.php`,
        type: 'GET',
        data: { save_name: notepadName }, // Sending the notepad name as a query parameter
        dataType: 'json',
        success: function(data) {
            if (data.notes) {
                // Load the content of the notepad into the textarea
                $('#notepadArea').val(data.notes);
                // Optionally, you can also store the current notepad in localStorage
                localStorage.setItem('currentNotepad', notepadName);
            } else {
                alert('No content found for this notepad');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading notepad content:', error);
        }
    });
}


// Function to save note to local storage and server
function saveNote() {
    const note = document.getElementById('notepadArea').value;

    // Save to local storage
    localStorage.setItem('userNote', note);

    // Save to server (you can create an API to handle saving notes to the database)
    const saveName = localStorage.getItem('currentNotepad') || 'default.txt';  // Use current notepad name or default name
    const data = {
        save_name: saveName,
        notes: note
    };

    fetch('http://localhost/OS-GITHUB/AI-OS/AI-OS/OS/api/notepad/saveNotepad.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Note saved!');
        } else {
            alert('Error saving note');
        }
    })
    .catch(error => console.error('Error saving note:', error));
}

// Function to clear the note in the textarea and local storage
function clearNote() {
    if (confirm('Clear all notes?')) {
        document.getElementById('notepadArea').value = '';
        localStorage.removeItem('userNote');
        localStorage.removeItem('currentNotepad');
    }
}

// Load saved note when modal is opened
document.addEventListener('DOMContentLoaded', function () {
    const savedNote = localStorage.getItem('userNote');
    if (savedNote) {
        document.getElementById('notepadArea').value = savedNote;
    }
    
    // Load the list of notepads on modal open
    loadNotepadList();
});


// Call the function for AI Folders Modal
toggleModalMaximization('aiFoldersModalDialog', 'maximizeFoldersBtn');

// Call the function for AI Links Modal
toggleModalMaximization('aiLinksModalDialog', 'maximizeLinksBtn');

// Call the function for Notes Modal
toggleModalMaximization('notesModalDialog', 'maximizeNotesBtn');

// Terminal commands
document.addEventListener('DOMContentLoaded', function () {
    const terminalInput = document.getElementById('terminalInput');
    const terminalBody = document.getElementById('terminalBody');

    terminalInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            const command = terminalInput.value.trim();
            if (command) {
                // Echo the typed command with correct prompt
                const newLine = document.createElement('p');
                newLine.innerHTML = ` 
                    <span class="terminal-prompt">
                        <span class="text-red">user</span><span class="text-grey">@</span><span class="text-green">ubuntu</span><span class="text-grey">:~$</span>
                    </span> ${command}
                `;
                terminalBody.insertBefore(newLine, terminalInput.parentElement);

                // Fake response for some commands
                const response = document.createElement('p');
                if (command.toLowerCase() === 'help') {
                    response.innerHTML = "<span class='text-grey'>Available commands: help, clear</span>";
                } else if (command.toLowerCase() === 'clear') {
                    // Clear only the content below the terminal prompt
                    const content = terminalBody.querySelectorAll('p');
                    content.forEach(p => {
                        if (!p.contains(terminalInput)) {
                            p.remove(); // Remove command output only, not the prompt
                        }
                    });
                } else {
                    response.innerHTML = `<span class='text-grey'>Command not recognized: ${command}</span>`;
                }

                if (command.toLowerCase() !== 'clear') {
                    terminalBody.insertBefore(response, terminalInput.parentElement);
                }

                terminalInput.value = '';
                terminalBody.scrollTop = terminalBody.scrollHeight; // Scroll to bottom
            }
        }
    });
});



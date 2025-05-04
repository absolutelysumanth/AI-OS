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

// Call the function for AI Folders Modal
toggleModalMaximization('aiFoldersModalDialog', 'maximizeFoldersBtn');

// Call the function for AI Links Modal
toggleModalMaximization('aiLinksModalDialog', 'maximizeLinksBtn');

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

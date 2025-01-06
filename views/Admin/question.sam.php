<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.jpeg">
    <title>Add question | <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<header class="header">
        <div class="top1">
            <div class="logo"><img alt="" width="70rem" src="assets/img/logo.png"></div>
            <div class="app_name"><h1><?php echo APP_NAME; ?></h1></div>
        </div>
        <div class="top2">
            <nav>
                <ul>
                    <li><a href="/">home</a></li> |
                    <li><a href="boss">Dashboard</a></li>|
                    <li><a href="logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Create Questions</h1>
        <form id="questionnaire-form">
            <div id="questions-container">
                <div class="question">
                    <label for="question-1">Question 1:</label>
                    <input type="text" name="questions[]" placeholder="Enter question text" required>
                    <select name="input_types[]" required>
                        <option value="text">Text</option>
                        <option value="tel">Tel</option>
                        <option value="number">Number</option>
                        <option value="radio">Radio</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="textarea">Textarea</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                    <div class="options-container" style="display: none;">
                        <textarea name="options[]" placeholder="Enter options separated by commas"></textarea>
                    </div>
                    <button type="button" class="remove-question">Remove</button>
                </div>
            </div>
            <button type="button" id="add-question">Add Question</button>
            <button type="button" id="preview-form">Preview Form</button>
            <button type="submit">Save Questionnaire</button>
        </form>
        <div id="response"></div>
        <div id="preview-container"></div>
    </div>
    <footer>
        <div class="copy">
            <p><a href="https://www.reconnect.co.tz" target="_blank" rel="noopener noreferrer"><?php echo DEV; ?></a></p>
            <p><?php echo date('Y').'&copy;  ';  echo "UTPC"; ?></p>
        </div>
    </footer>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const questionsContainer = document.getElementById('questions-container');
    const addQuestionButton = document.getElementById('add-question');
    const previewButton = document.getElementById('preview-form');
    const form = document.getElementById('questionnaire-form');
    const responseDiv = document.getElementById('response');
    const previewContainer = document.getElementById('preview-container');

    // Add a new question
    addQuestionButton.addEventListener('click', () => {
        const questionCount = questionsContainer.querySelectorAll('.question').length + 1;
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question');
        newQuestion.innerHTML = `
            <label>Question ${questionCount}:</label>
            <input type="text" name="questions[]" placeholder="Enter question text" required>
            <select name="input_types[]" required>
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="tel">Tel</option>
                <option value="radio">Radio</option>
                <option value="checkbox">Checkbox</option>
                <option value="textarea">Textarea</option>
                <option value="dropdown">Dropdown</option>
            </select>
            <div class="options-container" style="display: none;">
                <textarea name="options[]" placeholder="Enter options separated by commas"></textarea>
            </div>
            <button type="button" class="remove-question">Remove</button>
        `;
        questionsContainer.appendChild(newQuestion);

        // Add event listeners for new elements
        attachEventListeners(newQuestion);
    });

    // Attach necessary event listeners
    function attachEventListeners(question) {
        const inputTypeSelect = question.querySelector('select');
        const optionsContainer = question.querySelector('.options-container');
        const removeButton = question.querySelector('.remove-question');

        // Show options container for specific input types
        inputTypeSelect.addEventListener('change', (e) => {
            if (['radio', 'checkbox', 'dropdown'].includes(e.target.value)) {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
                optionsContainer.querySelector('textarea').value = ''; // Clear options
            }
        });

        // Remove a question
        removeButton.addEventListener('click', () => {
            question.remove();
        });
    }

    // Initial event listener for the first question
    attachEventListeners(questionsContainer.querySelector('.question'));

    // Preview form
    previewButton.addEventListener('click', () => {
        previewContainer.innerHTML = '<h2>Form Preview</h2>';
        const questions = questionsContainer.querySelectorAll('.question');

        questions.forEach((question, index) => {
            const questionText = question.querySelector('input[name="questions[]"]').value;
            const inputType = question.querySelector('select[name="input_types[]"]').value;
            const options = question.querySelector('textarea[name="options[]"]').value.split(',');

            let inputElement = '';
            switch (inputType) {
                case 'text':
                    inputElement = `<input type="text" placeholder="${questionText}" />`;
                    break;
                case 'tel':
                    inputElement = `<input type="tel" placeholder="${questionText}" />`;
                    break;
                case 'number':
                    inputElement = `<input type="number" placeholder="${questionText}" />`;
                    break;
                case 'textarea':
                    inputElement = `<textarea placeholder="${questionText}"></textarea>`;
                    break;
                case 'radio':
                case 'checkbox':
                    inputElement = options
                        .map(
                            (option) =>
                                `<label><input type="${inputType}" name="q${index + 1}" /> ${option.trim()}</label>`
                        )
                        .join('<br>');
                    break;
                case 'dropdown':
                    inputElement = `
                        <select>
                            ${options
                                .map((option) => `<option>${option.trim()}</option>`)
                                .join('')}
                        </select>`;
                    break;
            }

            previewContainer.innerHTML += `
                <div>
                    <p><strong>${index + 1}. ${questionText}</strong></p>
                    ${inputElement}
                </div>
            `;
        });
    });

    // Handle form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        // fetch('http://localhost:8080/save_questionnaire.php', {
        //     method: 'POST',
        //     body: formData,
        // })
        //     .then(response => response.text()) // Log raw text for debugging
        //     .then(data => console.log(data))
        //     .catch(error => console.error("Fetch error:", error));
        
        fetch('http://localhost:8080/save_questionnaire.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                responseDiv.textContent = data.message;
                responseDiv.style.color = data.status === 'success' ? 'green' : 'red';
            })
            .catch((error) => {
                responseDiv.textContent = 'An error occurred.';
                responseDiv.style.color = 'red';
            });
    });
});

    </script>
</body>
</html>

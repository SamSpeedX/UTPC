document.addEventListener('DOMContentLoaded', () => {
    const questionsContainer = document.getElementById('questions-container');
    const addQuestionButton = document.getElementById('add-question');
    const previewButton = document.getElementById('preview-form');
    const form = document.getElementById('questionnaire-form');
    const responseDiv = document.getElementById('response');
    const previewContainer = document.getElementById('preview-container');

    // Add a new question
    addQuestionButton.addEventListener('click', () => {
        console.log("Adding a new question...");

        const questionCount = questionsContainer.querySelectorAll('.question').length + 1;
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question');
        newQuestion.innerHTML = `
            <label>Heading for Question ${questionCount}:</label>
            <input type="text" name="headings" placeholder="Enter heading for this question" required>
            <label>Question ${questionCount}:</label>
            <input type="text" name="questions[]" placeholder="Enter question text" required>
            <select name="input_types[]" required>
                <option value="text">Text</option>
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

        // Attach event listeners to the new question
        attachEventListeners(newQuestion);

        // Add to the DOM
        questionsContainer.appendChild(newQuestion);
        console.log("New question added:", newQuestion);
    });

    // Attach necessary event listeners
    function attachEventListeners(question) {
        const inputTypeSelect = question.querySelector('select');
        const optionsContainer = question.querySelector('.options-container');
        const removeButton = question.querySelector('.remove-question');

        // Show/hide options container based on input type
        inputTypeSelect.addEventListener('change', (e) => {
            console.log("Input type changed to:", e.target.value);
            if (['radio', 'checkbox', 'dropdown'].includes(e.target.value)) {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
                optionsContainer.querySelector('textarea').value = ''; // Clear options
            }
        });

        // Remove a question
        removeButton.addEventListener('click', () => {
            console.log("Removing question...");
            question.remove();
        });
    }

    // Attach listeners to the initial question
    attachEventListeners(questionsContainer.querySelector('.question'));

    // Preview form
    previewButton.addEventListener('click', () => {
        console.log("Previewing form...");
        previewContainer.innerHTML = '<h2>Form Preview</h2>';
        const questions = questionsContainer.querySelectorAll('.question');

        questions.forEach((question, index) => {
            const headingText = question.querySelector('input[name="headings"]').value;
            const questionText = question.querySelector('input[name="questions[]"]').value;
            const inputType = question.querySelector('select[name="input_types[]"]').value;
            const options = question.querySelector('textarea[name="options[]"]').value.split(',');

            let inputElement = '';
            switch (inputType) {
                case 'text':
                    inputElement = `<input type="text" placeholder="${questionText}" />`;
                    break;
                case 'textarea':
                    inputElement = `<textarea placeholder="${questionText}"></textarea>`;
                    break;
                case 'radio':
                case 'checkbox':
                    inputElement = options
                        .map((option) => `<label><input type="${inputType}" name="q${index + 1}" /> ${option.trim()}</label>`)
                        .join('<br>');
                    break;
                case 'dropdown':
                    inputElement = `<select>${options.map((option) => `<option>${option.trim()}</option>`).join('')}</select>`;
                    break;
            }

            previewContainer.innerHTML += `
                <div>
                    <h3>${headingText}</h3>
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

        console.log("Submitting form data:", [...formData.entries()]);

        fetch('save_questionnaire.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Response from server:", data);
                responseDiv.textContent = data.message;
                responseDiv.style.color = data.status === 'success' ? 'green' : 'red';
            })
            .catch((error) => {
                console.error("Fetch error:", error);
                responseDiv.textContent = 'An error occurred.';
                responseDiv.style.color = 'red';
            });
    });


//     const formData = new FormData();

// // Add headings for each question
// document.querySelectorAll('input[name="headers[]"]').forEach((headerInput) => {
//     formData.append('headers[]', headerInput.value);
// });

// // Add questions, input types, and options
// document.querySelectorAll('input[name="questions[]"]').forEach((questionInput, index) => {
//     formData.append('questions[]', questionInput.value);
//     formData.append('input_types[]', inputTypes[index].value);
//     formData.append('options[]', optionsArray[index].value || '');
// });

// // Submit the form
// fetch('save_questionnaire.php', {
//     method: 'POST',
//     body: formData,
// })
//     .then((response) => response.json())
//     .then((data) => {
//         console.log("Response from server:", data);
//     })
//     .catch((error) => {
//         console.error("Fetch error:", error);
//     });

});

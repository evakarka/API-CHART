import JustValidate from 'just-validate';

document.addEventListener('DOMContentLoaded', function() {
    new JustValidate('.js-form', {
        rules: {
            name: {
                required: true,
                minLength: 2,
                maxLength: 50
            },
            email: {
                required: true,
                email: true
            },
            age: {
                required: true,
                numeric: true,
                maxLength: 3
            },
            password: {
                required: true,
                minLength: 6,
                maxLength: 20
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            name: {
                required: 'Please enter your username',
                minLength: 'Username must be at least 2 characters long',
                maxLength: 'Username must be less than 50 characters long'
            },
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address'
            },
            age: {
                required: 'Please enter your age',
                numeric: 'Please enter a valid age',
                maxLength: 'Age must be less than 3 digits'
            },
            password: {
                required: 'Please enter a password',
                minLength: 'Password must be at least 6 characters long',
                maxLength: 'Password must be less than 20 characters long'
            },
            password_confirmation: {
                required: 'Please confirm your password',
                equalTo: 'Passwords do not match'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

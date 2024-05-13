const validation = new JustValidate("#signup", {
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true,
            remote: {
                url: "validate-email.php",
                data: {
                    email: function () {
                        return document.getElementById("email").value;
                    }
                }
            }
        },
        age: {
            required: true,
            numeric: true
        },
        password: {
            required: true,
            strength: {
                custom: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).{8,}$",
                message: "Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number"
            }
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        name: {
            required: "Please enter your username"
        },
        email: {
            required: "Please enter your email",
            email: "Please enter a valid email address",
            remote: "Email already taken"
        },
        age: {
            required: "Please enter your age",
            numeric: "Please enter a valid age"
        },
        password: {
            required: "Please enter your password",
            strength: "Please enter a stronger password"
        },
        password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Passwords should match"
        }
    },
    submitHandler: function (form, values) {
        form.submit();
    }
});

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#5267DF",
                secondary: "#FA5959",
                "dark-blue": "#242A45",
                "app-grey": "#9194A2",
                "app-white": "#f7f7f7",
            },
            animation: {
                fadeIn: "fadeIn 0.565s ease-in-out",
                "slide-left": "slide-left 0.565s ease-in-out",
                blob: "blob 7s infinite",
            },
            keyframes: {
                fadeIn: {
                    "0%": {
                        opacity: "0",
                    },
                    "100%": {
                        opacity: "1",
                    },
                },
                "slide-left": {
                    "0%": {
                        left: "-1000%",
                        opacity: "0.1",
                    },
                    "50%": {
                        opacity: "0.5",
                    },
                    "75%": {
                        opacity: "0.75",
                    },
                    "100%": {
                        left: "0%",
                        opacity: "1",
                    },
                },
                blob: {
                    "0%": {
                        transform: "translate(0px, 0px) scale(1)",
                    },
                    "33%": {
                        transform: "translate(30px, -50px) scale(1.1)",
                    },
                    "66%": {
                        transform: "translate(-20px, 20px) scale(0.9)",
                    },
                    "100%": {
                        transform: "tranlate(0px, 0px) scale(1)",
                    },
                },
            },
            gridTemplateRows: {
                "[auto,auto,1fr]": "auto auto 1fr",
            },
        },
        fontFamily: {
            Poppins: ["Poppins, sans-serif"],
        },
        container: {
            center: true,
            padding: "1rem",
            screen: {
                lg: "11240px",
                xl: "11240px",
                "2xl": "11240px",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/aspect-ratio"),
        require("daisyui"),
    ],

    daisyui: {
        styled: true,
        base: true,
        utils: true,
        themes: [
            {
                light: {
                    ...require("daisyui/src/colors/themes")[
                        "[data-theme=light]"
                    ],
                    primary: "#5267DF",
                    "primary-focus": "#5267DF",
                },
            },
        ],
        logs: true,
        rtl: false,
        prefix: "ds-",
    },
};

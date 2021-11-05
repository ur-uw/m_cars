module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                primary: "#5267DF",
                secondary: "#FA5959",
                "dark-blue": "#242A45",
                "app-grey": "#9194A2",
                "app-white": "#f7f7f7",
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
    variants: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};

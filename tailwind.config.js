/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      screens: {
        'tablet': { max: "768px" },
        'mobile': { max: "600px" },
      },
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
      colors: {
        "black-1": "#151d48",
        "gray-1": "#d9d9d9",
        "red-1" : "#FA5A7D",
      },
      fontWeight: {
        "poppins-500": "500",
        "poppins-600": "600",
        "poppins-700": "700",
        "poppins-800": "800",
      },
      backgroundColor: {
        "gray-1": "#f4f4f4",
        "gray-2" : "#F0F1F5",
        "gray-trans-1" : "#F8F9FA",
        "blue-1": "#4079ed",
        "blue-2": "#0547f3",
        "blue-trans-1": "#4d7bf3",
        "red-1" : "#FA5A7D",
        "red-trans-1" : "#FFE2E5",
        "overlay-1" : "rgba(0,0,0,0.5)",
        "bg-green-trans-1" : "#DCFCE7",
      },
      boxShadow: {
        "box-shadow-1":
          "rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;",
        "box-shadow-2":	"rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;",
        "box-shadow-3" : "rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;",
      },
      fontSize: {
        'normal': "12px",
        'small': "10px",
        'normales': "14px",
        'medium': "16px",
        'high': "18px",
        'highest': "20px",
        'heading': "24px",
      },
    },
    height : {
      'h-300' : '300px',
      'h-500' : '500px',
      'h-600' : '600px',
      'h-650' : '650px',
      'h-700' : '700px',
      'h-otomatis' : 'auto', 
      'h-100%' : '100%',
      'h-100vh' : '100vh',
    },
    minHeight : {
      'h-100vh' : '100vh',
    },
    gap : {
      'gap-10px' : '10px',
      'gap-20px' : '20px',
    },
    scale : {
      'mirror-1' : '-1',
    },
    maxWidth : {
      'w-500px' : '500px',
    },
    maxHeight : {
      'h-500' : '500px',
    }
  },
  plugins: [],
};

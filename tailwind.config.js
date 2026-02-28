import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
          fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            montser : "Montserrat"
        },
          transitionProperty: {
            'width': 'width',
            'spacing': 'margin, padding',
        },
        colors: {
          primary: '#E2F1E7',
          second: '#246F75',
          red: {
              101: "#DA6262",
          },
          green: {
              101: "#1C6065",
              102: "#2D8A91",
              103: "#3BA1A8",
              104: "#78CBD1",
              105: "#A1DCE0",
          },
          yellow: {
              101: "#D9E0A4",
          },
          blue: {
              101: "#2196f3",
              102: "#1F6FA4",
              103: "#19485F",
          },
        },
        keyframes: {
            'focus-in': {
              '0%': {
                filter: 'blur(12px)',
                opacity: '0',
              },
              '100%': {
                filter: 'blur(0)',
                opacity: '1',
              },
            },
            // 'chitchat': {
            //   '0%': {
            //     content: '#',
            //   },            
            //   '5%': {
            //     content: '.',
            //   },            
            //   '10%': {
            //     content: '^{',
            //   },            
            //   '15%': {
            //     content: '-!',
            //   },            
            //   '20%': {
            //     content: '#$_',
            //   },            
            //   '25%': {
            //     content: '№:0',
            //   },            
            //   '30%': {
            //     content: '#{+.',
            //   },            
            //   '35%': {
            //     content: '@}-?',
            //   },            
            //   '40%': {
            //     content: '?{4@%',
            //   },            
            //   '45%': {
            //     content: '=.,^!',
            //   },            
            //   '50%': {
            //     content: '?2@%',
            //   },            
            //   '55%': {
            //     content: '\;1}]',
            //   },            
            //   '60%': {
            //     content: '?{%:%',
            //     right: 0,
            //   },            
            //   '65%': {
            //     content: '|{f[4',
            //     right: 0,
            //   },            
            //   '70%': {
            //     content: '{4%0%',
            //     right: 0,
            //   },            
            //   '75%': {
            //     content: '1_0<',
            //     right: 0,
            //   },            
            //   '80%': {
            //     content: '{0%',
            //     right: 0,
            //   },            
            //   '85%': {
            //     content: ']>',
            //     right: 0,
            //   },            
            //   '90%': {
            //     content: '4',
            //     right: 0,
            //   },            
            //   '95%': {
            //     content: '2',
            //     right: 0,
            //   },            
            //   '100%': {
            //     content: ' ',
            //     right: 0,
            //   },
            // },
          },
          animation: {
            'focus-in': 'focus-in 1s cubic-bezier(0.550, 0.085, 0.680, 0.530) both',
            'chitchat': 'chitchat 1s linear both',
          },
        },
    },

    plugins: [forms],
};

/** @type {import("tailwindcss").Config} */
module.exports = {
  content: ['../app/**/*'],
  theme: {
    screens: {
      sm: "480px",
      md: "768px",
      lg: "976px",
      xl: "1440px"
    },
    fontFamily: {
      'urban' : ["Urbanist", 'sans-serif'],
      'dmsans' : ["DM Sans", 'sans-serif'],
      'sans': ['Roboto', 'sans-serif'],
    },
    extend: {
      spacing: {
        "5.5": "5.5rem",
        "6.5": "6.5rem",
      },
      dropShadow: {
        "card": "0px 5px 10px  rgba(0, 0, 0, 0.20)"
      },
      colors: {
        neutralLight: 'hsl(250,97.2%,78.4%)',
        neutral: 'hsl(250,97.2%,72.4%)',
        neutralDark: 'hsl(250,97.2%,64.4%)',
        primaryLight: 'hsl(256,91.7%,101.3%)',
        primary: 'hsl(256,91.7%,95.3%)',
        primaryDark: 'hsl(256,91.7%,87.3%)',
        ctaLight: 'hsl(86,100%,77.8%)',
        cta: 'hsl(86,100%,71.8%)',
        ctaDark: 'hsl(86,100%,63.8%)',
        gray: 'hsl(189,5.3%,31.7%)',
        dark: 'hsl(189,5.3%,17.7%)',
        red: 'hsl(0,78.9%,50.7%)',
        green: 'hsl(119,100%,37.8%)',
        twt: 'hsl(204,87.6%,52.7%)',
        fbk: 'hsl(222,66.8%,36.7%)',
        lnk: 'hsl(201,100%,35.9%)',
        ytb: 'hsl(0,100%,50%)',
        itg: 'hsl(327,58.8%,46.7%)'

      }
    },
  },
  plugins: [],
}


module.exports = {
  extends: ['eslint:recommended', 'prettier'],
  env: {
    browser: true,
    node: true
  },
  plugins: ['prettier'],
  rules: {
    'prettier/prettier': [
      'error',
      {
        singleQuote: true,
        trailingComma: 'none'
      }
    ],
    eqeqeq: ['error', 'always']
  },
  parserOptions: {
    ecmaVersion: 8,
    sourceType: 'module'
  }
};

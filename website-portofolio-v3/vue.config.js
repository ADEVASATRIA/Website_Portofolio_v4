module.exports = {
    // other options...
    compilerOptions: {
      isCustomElement: (tag) => tag.startsWith('Frontend')
    }
}
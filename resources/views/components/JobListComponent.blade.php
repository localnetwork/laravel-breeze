  
  <!-- Load your Vue app and the component -->

  <div id="test">


  </div>
  <script src="https://unpkg.com/vue@3"></script>
  <script setup>
    const { createApp, ref } = Vue
    createApp({
    setup() {
        const message = ref('Hello vue!')
        return {
        message
        }
    }
    }).mount('#test')
  </script>
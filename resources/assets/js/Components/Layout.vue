<template>
  <div>
    <header class="block pt-4 px-4 sm:pt-9 sm:px-0">
      <nav class="container mx-auto flex items-center">
        <div class="hidden sm:flex space-x-12 font-bold leading-tight text-sm">
          <Link href="/" class="text-indigo-400 hover:text-indigo-600">Indavideó letöltés</Link>
          <Link href="/api" class="text-indigo-400 hover:text-indigo-600">API</Link>
          <a href="https://stats.uptimerobot.com/nYB1qC7YwQ/784058498" target="_blank" class="text-indigo-400 hover:text-indigo-600">Status</a>
          <a href="https://github.com/nxu/indadl" target="_blank" class="text-indigo-400 hover:text-indigo-600">GitHub</a>
        </div>

        <div class="ml-auto">
          <DarkModeToggle></DarkModeToggle>
        </div>
      </nav>
    </header>
    <main>
      <slot></slot>
    </main>

    <Footer class="mt-16" v-if="!hideFooter"></Footer>
  </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import DarkModeToggle from '../Components/DarkModeToggle'
import Footer from '../Components/Footer'

export default {
  components: { DarkModeToggle, Footer, Link },

  props: {
    hideFooter: Boolean,
  }
}
</script>

<script setup>
import FrontendLayout from '@/Layouts/Frontend.vue';
import Hero from "@/Components/Frontend/Hero.vue";
import Promote from '@/Components/Frontend/Promote.vue';
import About from '@/Components/Frontend/About.vue';
import Skills from '@/Components/Frontend/Skills.vue';
import Portfolio from '@/Components/Frontend/Portfolio.vue';
import Services from '@/Components/Frontend/Services.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    skills: Object,
    projects: Object
});

</script>

<template>
    <Head title="Welcome To Potofolio" />
    <FrontendLayout>
        <!-- Hero primary-->
        <Hero />
        <!-- Promote tail-100-->
        <Promote />
        <!-- About Secondary Color -->
        <About />
        <!-- SKills tail-100 -->
        <Skills :skills="skills" />
        <!-- Portofolio primary colors -->
        <Portfolio :skills="skills" :projects="projects" />
        <!-- Services Secondary Colors-->
        <Services />
        <!-- Contact Primary -->
    </FrontendLayout>
</template>


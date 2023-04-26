<script setup>
import FrontendLayout from '@/Layouts/Frontend.vue';
import Hero from "@/Components/Frontend/Hero.vue";
import Promote from '@/Components/Frontend/Promote.vue';
import About from '@/Components/Frontend/About.vue';
import { Head, Link } from '@inertiajs/vue3';
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
        <!-- Portofolio primary colors -->
        <!-- Services Secondary Colors-->
        <!-- Contact Primary -->
    </FrontendLayout>
</template>


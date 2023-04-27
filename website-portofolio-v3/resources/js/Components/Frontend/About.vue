<template>
        <section id="about" class="section bg-light-secondary dark:bg-dark-secondary">
        <div
            class="container mx-auto"
            v-motion
            :initial="{
            opacity: 0,
            y: 100,
            }"
            :visible="{
            opacity: 1,
            y: 0,
            }"
        >
            <div class="flex flex-col xl:flex-row gap-24">
            <img
                class="object-cover h-full w-[566px] md:mx-auto lg:mx-0 rounded-2xl"
                src="http://127.0.0.1:8000/images/Hero.jpg"
                alt="about"
            />
            <div
                class="
                flex flex-col
                items-center
                text-center
                lg:items-start lg:text-left
                "
            >
                <div class="flex flex-col">
                <h2 class="text-3xl lg:text-4xl font-medium lg:font-extrabold mb-3">
                    About Me
                </h2>
                <P class="mb-4 text-accent">Adeva Satria Arif Wibawa </P>
                <hr class="mb-8 opacity-90 dark:opacity-5" />
                <p class="mb-8">
                    Greetings to all. Greetings, I'm Adeva Satria Arif Authority. 
                    I'm currently a student at Bina Nusantara University and I'm 20 years old. 
                    by selecting a computer science major. <br />
                    <br />
                    Future work in my field will center on being a Full Stack developer. 
                    by being familiar with front- and back-end developers. I'm presently majoring 
                    in / streaming in digital creative technology at Binus Malang as a result of this. 
                    I can learn a lot to become a Full Stack Developer by enrolling in the streaming.

                </p>
                </div>
                <a href="#contact" class="btn btn-md bg-accent text-light-tail-100">
                Contact me
                </a>
            </div>
            </div>
        </div>
        </section>
  </template>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div style="background-color: orange; border-top-right-radius:10px; border-top-left-radius:10px" class="w-full sm:max-w-md text-center; p-4">
            <img  style=" margin-left:45%" src="/assets/media/image/logo.png" alt="logo" />
          </div>
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>

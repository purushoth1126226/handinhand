<div
   @click="isSettingsPanelOpen = false"
   x-show.transition.opacity.100="isSettingsPanelOpen"
   class="fixed inset-0 z-20 bg-blue-400 bg-opacity-20"
   style="backdrop-filter: blur(10px)"
   >
</div>
<div
   x-show="isSettingsPanelOpen"
   x-transition:enter="transform duration-100"
   x-transition:enter-start="translate-x-full ease"
   x-transition:enter-end="translate-x-0 ease-in"
   x-transition:leave="transform duration-200"
   x-transition:leave-start="translate-x-0 ease-out"
   x-transition:leave-end="translate-x-full ease"
   class="fixed inset-y-0 right-0 z-30 w-full max-w-sm p-2 bg-white"
   >
   <button @click="toggleSettingsPanel" class="p-4 rounded-md">
      <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
   </button>
   <div class="p-4 bg-gray-300">
      <p> teset </p>
   </div>
</div>
<div>
    <button 
        type="button"
        x-data="{ 
            currentLocale: '{{ app()->getLocale() }}',
            switchLocale() {
                let newLocale = this.currentLocale === 'tr' ? 'en' : 'tr';
                fetch('/admin/locale/switch', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({ locale: newLocale })
                })
                .then(() => {
                    // Replace kullanarak history'ye eklenmesini önle
                    window.location.replace(window.location.pathname + window.location.search);
                });
            }
        }"
        x-on:click.prevent="switchLocale()"
        class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-gray fi-btn-color-gray fi-size-sm fi-btn-size-sm gap-1 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20"
    >
        <svg class="fi-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
        </svg>
        <span class="fi-btn-label" x-text="currentLocale.toUpperCase()">
            {{ strtoupper(app()->getLocale()) }}
        </span>
    </button>
</div>

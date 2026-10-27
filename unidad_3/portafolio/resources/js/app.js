import 'preline';

// Re-inicializa los plugins de Preline despues de cada navegacion de Livewire.
document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods?.autoInit();
});

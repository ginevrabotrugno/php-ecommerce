PHP E-COMMERCE
==========

Benvenuti nel progetto **php-ecommerce**, una piattaforma di e-commerce costruita utilizzando PHP puro e MySQL. Questo progetto è stato realizzato seguendo un videocorso su YouTube e rappresenta un punto di partenza per approfondire i concetti di programmazione ad oggetti (OOP) e migliorare la comprensione di PHP.

## Descrizione del progetto
Il progetto **php-ecommerce** è un'applicazione che simula un negozio online con funzionalità essenziali per l'acquisto e la gestione di prodotti. Pur non essendo stato sviluppato da zero, il codice è stato personalizzato e riorganizzato per consolidare concetti fondamentali di PHP e OOP.

### Funzionalità principali
- **Catalogo prodotti**: Visualizzazione dei prodotti disponibili, con dettagli come nome, prezzo e descrizione.
- **Carrello degli acquisti**: Sistema per aggiungere, rimuovere e modificare prodotti selezionati.
- **Autenticazione utenti**: Registrazione e login per accedere a funzionalità riservate.
- **Gestione ordini**: Visualizzazione dello storico ordini degli utenti registrati.
- **Pannello amministrativo**: Strumenti per la gestione di prodotti e monitoraggio degli ordini.
- **Persistenza dati**: Database MySQL per salvare informazioni relative a utenti, prodotti e ordini.

### Obiettivi del progetto
1. **Apprendimento PHP puro**: Sviluppo senza framework per comprendere meglio la logica di backend.
2. **Programmazione ad oggetti (OOP)**: Implementazione di classi e metodi per strutturare il codice.
3. **Interazione con database**: Creazione di tabelle e utilizzo di query SQL per gestire i dati.
4. **Pattern MVC**: Utilizzo del pattern Model-View-Controller per separare logica e interfaccia.

## Struttura del progetto
La struttura del progetto è organizzata come segue:

- `/admin` - Contiene le funzionalità riservate all'amministratore per la gestione dei prodotti e degli ordini.
- `/assets` - File statici come immagini, file CSS e JavaScript.
- `/auth` - File per la gestione dell'autenticazione degli utenti.
- `/classes` - Contiene le classi PHP principali come `Cart.php`, `DB.php`, `Product.php` e `User.php`.
- `/inc` - File di configurazione, come `config.php`, `functions.php`, `globals.php` e `init.php`.
- `/public` - File accessibili pubblicamente, come il template di intestazione, sidebar e footer.
- `/shop` - Contiene le funzionalità relative alla visualizzazione dei prodotti e del carrello.
- `/user` - File relativi alla gestione del profilo e degli ordini dell'utente.

Ogni cartella contiene un file `index.php` con una struttura standard per includere i file di configurazione e le diverse parti del template, insieme con delle sottocartelle "pages" che contengono le viste specifiche di ogni pagina.

## Sviluppo
Il progetto è stato realizzato seguendo una guida video, con modifiche per esplorare concetti chiave di PHP e OOP. Lo scaffolding del progetto è stato fornito dal corso, ma personalizzato per apprendere meglio la struttura e il funzionamento di un'applicazione e-commerce.

### Caratteristiche tecniche
- **Sessioni PHP**: Utilizzate per autenticazione e gestione del carrello.
- **CRUD prodotti**: Creazione, modifica e eliminazione di prodotti dal catalogo.
- **Carrello dinamico**: Aggiornamenti in tempo reale per il totale del carrello.

## Autore
Sviluppato da [Ginevra Botrugno](https://github.com/ginevrabotrugno) come parte di un percorso di studio personale per approfondire PHP e la programmazione orientata agli oggetti.


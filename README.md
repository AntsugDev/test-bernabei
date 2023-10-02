# SPIEGAZIONE PROGETTO

### Consumare una api pubblica qualsiasi (sei libero di scegliere un servizio a piacere, ad esempio come https://any-api.com/ o https://apilist.fun/) e aggregare i dati ricevuti in qualche modo

E' stata creata un api usando come base le seguenti api fake <a href="https://fakestoreapi.com/docs">Api</a>. utilizzando come apiper il test "products".
E' stato creato il controller <pre>App\Controller\ConsumerController::index</pre> <br /> dove è stat creata l'api esposta in post; di seguito un esempio di come deve essere invocata <br /><pre>curl --request POST \
  --url 'http://localhost:8000/api/consumer/post?page=0&size=1&sortBy=title&order=desc' \
  --header 'User-Agent: insomnia/8.1.0'</pre><br />La response è stata aggregata creando un oggetto Pageable simile a quello di SpringBoot.

  ***

  
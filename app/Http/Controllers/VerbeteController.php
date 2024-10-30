<?php

namespace App\Http\Controllers;

use App\Models\Verbete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerbeteController extends Controller
{

    // LIST VIEW
    public function index()
    {
        $query = $this->queryString(request()->query());
        $verbetes = Verbete::filter(request(['search']))->paginate(30);
        session(['query' => ($query)]);

        return view('verbetes.index', [
            'verbetes' => $verbetes, // RowsData
            'baseRoute' => '/verbetes', //BaseRoute
            'title' => 'Verbetes',
            'query' => $query,
        ]);
    }

    // SHOW / EDIT VIEW
    public function show(Verbete $verbete)
    {
        $query = session()->get('query');
        $compradores = $verbete->compradores($verbete->id)->values()->unique('id');
        $licitantes = $verbete->licitantes($verbete->id)->values()->unique('id');
        $lista_autores = $this->listaGeralAutores();
        return view('verbetes.show', [
            'verbete' => $verbete,
            'baseRoute' => '/verbetes',
            'title' => 'Verbetes',
            'query' => $query,
            'itemsContrato' => Verbete::find($verbete->id)->itemsContrato,
            'itemsLeilao' => Verbete::find($verbete->id)->itemsLeilao->sortByDesc('leilao_id'),
            'compradores' => $compradores,
            'licitantes' => $licitantes,
            'lista_autores' => $lista_autores,
        ]);
    }

    // PRINT VIEW
    public function print(Verbete $verbete)
    {
        return view('verbetes.print', [
            'verbete' => $verbete,
            'itemsLeilao' => Verbete::find($verbete->id)->itemsLeilao->sortByDesc('leilao_id'),
        ]);
    }


    // CREATE VIEW
    public function create()
    {
        $query = session()->get('query');
        $lista_autores = $this->listaGeralAutores();

        return view('verbetes.create', [
            'baseRoute' => '/verbetes',
            'title' => 'Verbetes',
            'query' => $query,
            'lista_autores' => $lista_autores,

        ]);
    }
    // LISTA GERAL DE AUTORES PARA DROPDOWN
    public function listaGeralAutores()
    {
        $autores = Verbete::pluck('author');
        $lista_autores = $autores->unique();
        $lista_autores->values()->all();
        $dropdown_autores = array();
        foreach ($lista_autores as $row) {
            $dropdown_autores[] = array(
                'label'     =>  $row,
                'value'     =>  $row
            );
        };
        return $dropdown_autores;
    }

    // STORE
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'author' => 'nullable',
            'title' => 'required',
            'mentions' => 'nullable',
            'place' => 'nullable',
            'printer' => 'nullable',
            'date' => 'nullable',
            'colaccao' => 'nullable',
            'comment' => 'nullable',
            'comment_en' => 'nullable',
            'bibliography' => 'nullable',
            'tags' => 'nullable',
            'notes' => 'nullable'
        ]);
        if ($formFields['comment_en'] == "") {
            $formFields['comment_en'] = $this->translateToEnglish($formFields['comment']);
        }

        $lastVerbete = Verbete::create($formFields);

        return redirect('/verbetes/' . $lastVerbete->id)->with('message', 'Verbete Criado com Sucesso');
    }

    // UPDATE
    public function update(Request $request, Verbete $verbete)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'author' => 'nullable',
            'title' => 'required',
            'mentions' => 'nullable',
            'place' => 'nullable',
            'printer' => 'nullable',
            'date' => 'nullable',
            'colaccao' => 'nullable',
            'comment' => 'nullable',
            'comment_en' => 'nullable',
            'bibliography' => 'nullable',
            'tags' => 'nullable',
            'notes' => 'nullable'
        ]);
        if ($formFields['comment_en'] == "") {
            $formFields['comment_en'] = $this->translateToEnglish($formFields['comment']);
        }

        $verbete->update($formFields);

        return back()->with('message', 'Verbete Gravado com Sucesso');
    }

    // DELETE
    public function delete(Verbete $verbete)
    {
        $query = session()->get('query');
        $verbete->delete();
        return redirect('/verbetes' . $query)->with('message', 'Verbete apagado com sucesso');
    }

    // DUPLICATE RECORD
    public function duplicate(Verbete $verbete)
    {
        $dupVerbete = $verbete->replicate();
        $dupVerbete->name = $verbete->name . " (Duplicado)";
        $dupVerbete->save();
        return redirect('/verbetes/' . $dupVerbete->id)->with('message', 'Verbete Duplicado com Sucesso');
    }

    // FUNCTIONS

    // QUERY IN SEARCH STRING
    private function queryString($query)
    {
        if (!empty($query)) {
            $getElements = '';
            foreach ($query as $key => $value) {
                $getElements .= $key . '=' . $value . '&';
            }
            $getElements = substr($getElements, 0, -1);

            return '?' . $getElements;
        }
    }
    // MODAL

    // LIST VIEW
    public function indexModal(Request $request)
    {
        if ($request->filled('search')) {
            $verbetes = Verbete::filter(request(['search']))->get()->sortBy('name');
            return view('verbetes.modal.index', [
                'verbetes' => $verbetes, // RowsData
            ]);
        }
    }

    // CREATE VIEW
    public function createModal()
    {
        $lista_autores = $this->listaGeralAutores();
        return view('verbetes.modal.create', [
            'lista_autores' => $lista_autores,
        ]);
    }

    // SHOW VIEW
    public function showModal(Verbete $verbete)
    {
        $lista_autores = $this->listaGeralAutores();
        return view('verbetes.modal.show', [
            'verbete' => $verbete,
            'lista_autores' => $lista_autores,
        ]);
    }

    // EDIT VIEW
    public function editModal(Verbete $verbete)
    {
        $lista_autores = $this->listaGeralAutores();
        return view('verbetes.modal.edit', [
            'verbete' => $verbete,
            'lista_autores' => $lista_autores,
        ]);
    }

    // STORE
    public function storeModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author' => 'nullable',
            'title' => 'required',
            'mentions' => 'nullable',
            'place' => 'nullable',
            'printer' => 'nullable',
            'date' => 'nullable',
            'colaccao' => 'nullable',
            'comment' => 'nullable',
            'comment_en' => 'nullable',
            'bibliography' => 'nullable',
            'tags' => 'nullable',
            'notes' => 'nullable'
        ]);


        if ($validator->fails()) {
            return view('verbetes.modal.create')->with(
                'error',
                ['Houve um err']
            );
        };

        $formFields = $validator->validated();
        if ($formFields['comment_en'] == "") {
            $formFields['comment_en'] = $this->translateToEnglish($formFields['comment']);
        }


        $verbete = Verbete::create($formFields);
        $lista_autores = $this->listaGeralAutores();
        return view('verbetes.modal.show', [
            'verbete' => $verbete,
            'lista_autores' => $lista_autores,
        ]);
    }

    // UPDATE
    public function updateModal(Request $request, Verbete $verbete)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'author' => 'nullable',
            'title' => 'required',
            'mentions' => 'nullable',
            'place' => 'nullable',
            'printer' => 'nullable',
            'date' => 'nullable',
            'colaccao' => 'nullable',
            'comment' => 'nullable',
            'comment_en' => 'nullable',
            'bibliography' => 'nullable',
            'tags' => 'nullable',
            'notes' => 'nullable'

        ]);
        if ($formFields['comment_en'] == "") {
            $formFields['comment_en'] = $this->translateToEnglish($formFields['comment']);
        }


        $verbete->update($formFields);
        $verbete_updated = $verbete;
        // dd($verbete_updated);
        $lista_autores = $this->listaGeralAutores();

        return view('verbetes.modal.show', [
            'verbete' => $verbete_updated,
            'lista_autores' => $lista_autores,
        ]);
    }

    // DUPLICATE RECORD
    public function duplicateModal(Verbete $verbete)
    {
        $dupVerbete = $verbete->replicate();
        $dupVerbete->name = $verbete->name . " (Duplicado)";
        $dupVerbete->save();
        $lista_autores = $this->listaGeralAutores();

        return view('verbetes.modal.edit', [
            'verbete' => $dupVerbete,
            'lista_autores' => $lista_autores,
        ]);
    }

    public function translateToEnglish($comment)
    {
        $apiKey = 'Example apiKEY';
        $url = 'https://translation.googleapis.com/language/translate/v2?key=' . $apiKey;
        $data = array(
            'q' => $comment,
            'target' => 'en'
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode($data),
                'header' => 'Content-Type: application/json'
            )
        );

        $context = stream_context_create($options);
        $response = json_decode(file_get_contents($url, false, $context), true);

        if ($response['data']['translations'][0]['detectedSourceLanguage'] != 'en') {
            $translationNote = "<p>! Please note that this translated text was generated by Google. !</p>";
            $translatedText = htmlspecialchars_decode($response['data']['translations'][0]['translatedText'], ENT_QUOTES) . $translationNote;
            return $translatedText;
        } else {
            return "";
        }
    }
}

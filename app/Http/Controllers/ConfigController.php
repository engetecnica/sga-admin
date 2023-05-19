<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function edit()
    {
        $config = Config::find(1);

        return view('pages.configuracoes.index', compact('config'));
    }

    public function update(UpdateConfigRequest $request)
    {
        if (! $save = Config::find(1)) {

            Config::create($request->validated());

            return redirect()->route('config.edit')->with('success', 'Registro atualizado com sucesso.');
        }

        $data = $request->validated();
        $data = $save->update($data);


        if ($data) {
            return redirect()->route('config.edit')->with('success', 'Registro atualizado com sucesso.');
        }


    }

}

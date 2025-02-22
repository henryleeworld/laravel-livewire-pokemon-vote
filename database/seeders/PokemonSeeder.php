<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PokemonSeeder extends Seeder
{
    private function getAllPokemon(): array
    {
        $query = <<<'GRAPHQL'
        query {
            pokemon_v2_pokemon(order_by: {id: asc}) {
                name
                id
                pokemon_v2_pokemonspecy {
                    name
                }
            }
        }
        GRAPHQL;

        $response = Http::post('https://beta.pokeapi.co/graphql/v1beta', [
            'query' => $query,
        ])->throw()->json();

        return array_map(fn ($pokemon) => [
            'name' => $pokemon['pokemon_v2_pokemonspecy']['name'],
            'dex_id' => $pokemon['id'],
        ], $response['data']['pokemon_v2_pokemon']);
    }

    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $this->command->info(__('Fetching Pokémon data from PokeAPI...'));

        $allPokemon = $this->getAllPokemon();
        $totalPokemon = count($allPokemon);

        foreach ($allPokemon as $index => $pokemon) {
            $pokemon['name'] = ucfirst($pokemon['name']);
            $this->command->info(__('Processing') . ' ' . __($pokemon['name']) . ' (' . ($index + 1). '/' . $totalPokemon . ')');

            Pokemon::firstOrCreate(
                ['dex_id' => $pokemon['dex_id']],
                [
                    'name' => $pokemon['name'],
                    'sprite' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$pokemon['dex_id']}.png",
                ]
            );
        }

        $this->command->info(__('Pokémon data seeding completed!'));
    }
}

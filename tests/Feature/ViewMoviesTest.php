<?php

namespace Tests\Feature;


use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facade\Ignition\Solutions\LivewireDiscoverSolution;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function the_main_page_shows_the_correct_info(){

        Http::fake();
        $response = $this->get(route('movies.index'));

        //$response->assertSuccessful();

        $response->assertSee('Popular Movies');
    }

    public function the_search_dropdown_works_correctly(){

        Livewire::test('search-dropdown')
                    ->assertDontSee('jumanji')
                    ->set('search', 'jumanji');
    }
}

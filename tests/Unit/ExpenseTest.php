<?php

namespace Tests\Unit;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_scenario()
    {
        (new DatabaseSeeder())->run();

        $this->post(route('approvers.store', ['name' => 'Ana']))->assertSuccessful();
        $this->post(route('approvers.store', ['name' => 'Ani']))->assertSuccessful();
        $this->post(route('approvers.store', ['name' => 'Ina']))->assertSuccessful();

        $this->post(route('approval-stages.store', ['approver_id' => 1]))->assertSuccessful();
        $this->post(route('approval-stages.store', ['approver_id' => 2]))->assertSuccessful();
        $this->post(route('approval-stages.store', ['approver_id' => 3]))->assertSuccessful();

        $this->post(route('expense.store', ['amount' => 100000]))->assertSuccessful();
        $this->post(route('expense.store', ['amount' => 220000]))->assertSuccessful();
        $this->post(route('expense.store', ['amount' => 330000]))->assertSuccessful();
        $this->post(route('expense.store', ['amount' => 400000]))->assertSuccessful();

        //approval expense
        $this->patch(route('expense.approve', ['id' => 1, 'approver_id' => 1]))->assertSuccessful();
        $this->patch(route('expense.approve', ['id' => 1, 'approver_id' => 2]))->assertSuccessful();
        $this->patch(route('expense.approve', ['id' => 1, 'approver_id' => 3]))->assertSuccessful();

        $this->patch(route('expense.approve', ['id' => 2, 'approver_id' => 1]))->assertSuccessful();
        $this->patch(route('expense.approve', ['id' => 2, 'approver_id' => 2]))->assertSuccessful();

        $this->patch(route('expense.approve', ['id' => 3, 'approver_id' => 1]))->assertSuccessful();

        //get expense
        $this->getJson(route('expense.show', ['id' => 1]))
            ->assertStatus(200)
            ->assertJson([
                'status'    => [
                    'name'  => 'disetujui'
                ]
            ]);

        $this->getJson(route('expense.show', ['id' => 2]))
            ->assertStatus(200)
            ->assertJson([
                'status'    => [
                    'name'  => 'menunggu persetujuan'
                ]
            ]);

        $this->getJson(route('expense.show', ['id' => 3]))
            ->assertStatus(200)
            ->assertJson([
                'status'    => [
                    'name'  => 'menunggu persetujuan'
                ]
            ]);

        $this->getJson(route('expense.show', ['id' => 4]))
            ->assertStatus(200)
            ->assertJson([
                'status'    => [
                    'name'  => 'menunggu persetujuan'
                ]
            ]);
    }
}

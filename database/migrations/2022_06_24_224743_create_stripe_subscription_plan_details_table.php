<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripeSubscriptionPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_subscription_plan_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stripe_product_id');
            $table->unsignedInteger('price');
            $table->string('display_price');
            $table->text('description');
            $table->enum('tier', [
                'free',
                'regular',
                'premium',
            ])->default('free');
            $table->unsignedInteger('trial_length_days')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stripe_subscription_plan_details');
    }
}

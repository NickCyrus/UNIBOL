<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(ModulesappsTableSeeder::class);
        $this->call(ProfpermissionsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ListasTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(PruebaTableSeeder::class);
        $this->call(AcEnterpriseRelsTableSeeder::class);
        $this->call(ActivityLogTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(ContractsItemsTableSeeder::class);
        $this->call(DiversosTableSeeder::class);
        $this->call(EquipmentsTableSeeder::class);
        $this->call(EquipmentssubTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(IeAccountStatusesTableSeeder::class);
        $this->call(IeAccountTypesTableSeeder::class);
        $this->call(IeAccountingDocumentsTableSeeder::class);
        $this->call(IeAccountsTableSeeder::class);
        $this->call(IeAprobationDocumentsTableSeeder::class);
        $this->call(IeBankMovementTypesTableSeeder::class);
        $this->call(IeBanksTableSeeder::class);
        $this->call(IeClassificationsTableSeeder::class);
        $this->call(IeCompaniesTableSeeder::class);
        $this->call(IeCompanyBankAccountsTableSeeder::class);
        $this->call(IeCompanyCostcentersTableSeeder::class);
        $this->call(IeConceptsTableSeeder::class);
        $this->call(IeCostCenterTypeClassificationsTableSeeder::class);
        $this->call(IeCostCentersTableSeeder::class);
        $this->call(IeIncomeExpensesTableSeeder::class);
        $this->call(IeMovementTypeClassificationsTableSeeder::class);
        $this->call(IeMovementTypesTableSeeder::class);
        $this->call(IeSubC2CostCentersTableSeeder::class);
        $this->call(IeSubCostcentersTableSeeder::class);
        $this->call(IeThirdClasificationsTableSeeder::class);
        $this->call(IeThirdpartiesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(ListopctionsTableSeeder::class);
        $this->call(LogActionsTableSeeder::class);
        $this->call(LogLoginsTableSeeder::class);
        $this->call(LogsSendMailTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(MeasuresTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
       // $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(PptoeqheTableSeeder::class);
        $this->call(PptomdoTableSeeder::class);
        $this->call(PptotecTableSeeder::class);
        $this->call(PptovariosTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(QuotesTableSeeder::class);
        $this->call(QuotesItemsTableSeeder::class);
        $this->call(QuotesStatesTableSeeder::class);
        $this->call(SalarysTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
    }
}

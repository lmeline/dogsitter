 public function showPrestations()
{
  $user = Auth::user();

    if ($user->prestationsAsproprietaire) {
        // Prestations où l'utilisateur est le propriétaire
        $prestations = $user->prestationsAsproprietaire;

        $prestationDogs = Prestation::with('prestationDogs.dog')->get();


    } elseif ($user->prestationsAsdogsitter) {
        // Prestations où l'utilisateur est le dog sitter
        $prestations = $user->prestationsAsdogsitter;
    } else {
        $prestations = collect(); // Aucun rôle spécifique, renvoyer une collection vide
    }

    return view('myprestations', compact('prestations'));
}
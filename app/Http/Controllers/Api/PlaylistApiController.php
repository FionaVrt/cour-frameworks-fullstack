namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // User connecté via Sanctum

        $playlists = Playlist::with('tracks') // si tu veux inclure les musiques
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'playlists' => $playlists
        ]);
    }
}

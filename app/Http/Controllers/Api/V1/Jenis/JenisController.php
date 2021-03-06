<?php
namespace SimdesApp\Http\Controllers\Api\V1\Jenis;

use SimdesApp\Http\Requests;
use SimdesApp\Http\Controllers\Controller;
use SimdesApp\Http\Controllers\Api\V1\Jenis;
use SimdesApp\Repositories\Contracts\JenisInterface;
use SimdesApp\Repositories\Jenis\JenisRepository;
use SimdesApp\Http\Requests\Jenis\JenisCreateForm;
use SimdesApp\Http\Requests\Jenis\JenisEditForm;
class JenisController extends Controller
{

    /**
     * @var
     */
    protected $jenis;

    /**
     * @param JenisInterface $jenis
     */
    public function __construct(JenisInterface $jenis)
    {
        $this->jenis = $jenis;
    }

    /**
     * Show data
     * URL = url/api/v1/backoffice/jenis GET
     *
     * @param JenisRepository $jenis
     *
     * @return mixed
     */
    public function index()
    {
        return $this->jenis->find($this->input('page'), $limit = 10, $this->input('term'));
    }

    /**
     * Create data Jenis
     * URL = url/api/v1/backoffice/jenis POST
     *
     * @param JenisCreateForm $request
     * @param JenisRepository $jenis
     *
     * @return mixed
     */
    public function store(JenisCreateForm $request)
    {
        return $this->jenis->create($request->all());
    }

    /**
     * Show detail Jenis
     * URL = url/api/v1/backoffice/jenis/1 GET
     *
     * @param JenisRepository $jenis
     * @param                 $id
     *
     * @return \Illuminate\Support\Collection|null|static
     */
    public function show($id)
    {
        return $this->jenis->findById($id);
    }

    /**
     * Update data Jenis
     * URL = url/api/v1/backoffice/jenis/1 PUT
     *
     * @param                 $id
     * @param JenisEditForm   $request
     * @param JenisRepository $jenis
     *
     * @return mixed
     */
    public function update($id, JenisEditForm $request)
    {
        return $this->jenis->update($id, $request->all());
    }

    /**
     * Delete data Jenis
     * URL = url/api/v1/backoffice/jenis/1 DELETE
     *
     * @param                 $id
     * @param JenisRepository $jenis
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->jenis->destroy($id);
    }
}

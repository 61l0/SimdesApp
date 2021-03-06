<?php namespace SimdesApp\Http\Controllers\Api\V1\Organisasi;

use SimdesApp\Http\Requests;
use SimdesApp\Http\Controllers\Controller;
use SimdesApp\Http\Controllers\Api\V1\Organisasi;
use SimdesApp\Repositories\Contracts\OrganisasiInterface;
use SimdesApp\Repositories\Organisasi\OrganisasiRepository;
use SimdesApp\Http\Requests\Organisasi\OrganisasiCreateForm;
use SimdesApp\Http\Requests\Organisasi\OrganisasiEditForm;


class OrganisasiController extends Controller
{

    /**
     * @var OrganisasiInterface
     */
    protected $organisasi;

    /**
     * Create new OrganisasiController Instance
     *
     * @param OrganisasiInterface $organisasi
     */
    public function __construct(OrganisasiInterface $organisasi)
    {
        $this->organisasi = $organisasi;
    }

    /**
     * Show data
     * URL = url/api/v1/backoffice/organisasi GET
     *
     * @param OrganisasiRepository $organisasi
     * @return mixed
     */
    public function index(OrganisasiRepository $organisasi)
    {
        return $organisasi->find($this->input('page'), $limit = 10, $this->input('term'));
    }

    /**
     * Create data
     * URL = url/api/v1/backoffice/organisasi POST
     *
     * @param OrganisasiCreateForm $request
     * @param OrganisasiRepository $organisasi
     * @return mixed
     */
    public function store(OrganisasiCreateForm $request, OrganisasiRepository $organisasi)
    {
        return $organisasi->create($request->all());
    }

    /**
     * Show detail
     * URL = url/api/v1/backoffice/organisasi/1 GET
     *
     * @param OrganisasiRepository $organisasi
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function show(OrganisasiRepository $organisasi, $id)
    {
        return $organisasi->findById($id);
    }

    /**
     * Update data
     * URL = url/api/v1/backoffice/organisasi/1 PUT
     *
     * @param $id
     * @param OrganisasiEditForm $request
     * @param OrganisasiRepository $organisasi
     * @return mixed
     */
    public function update($id, OrganisasiEditForm $request, OrganisasiRepository $organisasi)
    {
        return $organisasi->update($id, $request->all());
    }

    /**
     * Delete data
     * URL = url/api/v1/backoffice/organisasi/1 DELETE
     *
     * @param $id
     * @param OrganisasiRepository $organisasi
     * @return mixed
     */
    public function destroy($id, OrganisasiRepository $organisasi)
    {
        return $organisasi->destroy($id);
    }

    /**
     * @return mixed
     */
    public function getModalOrganisasi()
    {
        $term = $this->input('term');
        $page = $this->input('page');

        return $this->organisasi->find($page, $per_page = 5, $term);
    }

    /**
     *
     * @return mixed
     */
    public function trashed()
    {
        return $this->organisasi->getTrashed();
    }

    /**
     *
     * @return mixed
     */
    public function restore()
    {
        return $this->organisasi->getRestore();
    }

    /**
     * @return mixed
     */
    public function getDesa()
    {
        return $this->organisasi->findById($this->getOrganisasiId());
    }
}

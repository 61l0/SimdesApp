<?php namespace SimdesApp\Repositories\Bidang;

use SimdesApp\Models\Bidang;
use SimdesApp\Repositories\AbstractRepository;
use SimdesApp\Repositories\Program\ProgramRepository;
use SimdesApp\Services\LaraCacheInterface;

class BidangRepository extends AbstractRepository
{
    /**
     * @var ProgramRepository
     */
    protected $program;

    /**
     * @var LaraCacheInterface
     */
    protected $cache;

    /**
     * @param Bidang $bidang
     * @param ProgramRepository $program
     * @param LaraCacheInterface $cache
     */
    public function __construct(Bidang $bidang, ProgramRepository $program, LaraCacheInterface $cache)
    {
        $this->model = $bidang;
        $this->program = $program;
        $this->cache = $cache;
    }

    /**
     * Instant find or search with paging, limit, and query
     *
     * @param int $page
     * @param int $limit
     * @param null $term
     * @return mixed
     */
    public function find($page = 1, $limit = 10, $term = null)
    {
        // Create Key for cache
        $key = 'bidang-find-' . $page . $limit . $term;

        // Create Section
        $section = 'bidang';

        // If cache is exist get data from cache
        if ($this->cache->has($section, $key)) {
            return $this->cache->get($section, $key);
        }

        // Search data
        $bidang = $this->model
            ->orderBy('kode_rekening', 'asc')
            ->where('kode_rekening', 'like', '%' . $term . '%')
            ->paginate($limit)
            ->toArray();

        // Create cache
        $this->cache->put($section, $key, $bidang, 10);

        return $bidang;
    }

    /**
     * Create data
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try {
            $bidang = $this->getNew();

            $bidang->kode_rekening = e($data['kode_rekening']);
            $bidang->kewenangan_id = e($data['kewenangan_id']);
            $bidang->bidang = e($data['bidang']);

            $bidang->save();

            // Return result success
            return $this->successInsertResponse();

        } catch (\Exception $ex) {
            \Log::error('BidangRepository create action something wrong -' . $ex);
            return $this->errorInsertResponse();
        }
    }

    /**
     * Show the Record
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update the record
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        try {
            $bidang = $this->findById($id);

            $bidang->kode_rekening = e($data['kode_rekening']);
            $bidang->kewenangan_id = e($data['kewenangan_id']);
            $bidang->bidang = e($data['bidang']);

            $bidang->save();

            // Return result success
            return $this->successUpdateResponse();

        } catch (\Exception $ex) {
            \Log::error('BidangRepository update action something wrong -' . $ex);
            return $this->errorUpdateResponse();
        }
    }

    /**
     * Destroy the record
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $bidang = $this->findById($id);

            if ($bidang) {
                $result = $this->cekForDelete($bidang->_id);
                if (count($result) > 0) {
                    return $this->relationDeleteResponse();
                }

                $bidang->delete();

                return $this->successDeleteResponse();
            }

            return $this->emptyDeleteResponse();

        } catch (\Exception $ex) {
            \Log::error('BidangRepository destroy action something wrong -' . $ex);
            return $this->errorDeleteResponse();
        }
    }

    /**
     * check program before delete
     *
     * @param $bidang_id
     *
     * @return mixed
     */
    public function cekForDelete($bidang_id)
    {
        return $this->program->findIsExists($bidang_id);
    }

    /**
     * @param $kewenangan_id
     *
     * @return mixed
     */
    public function findIsExists($kewenangan_id)
    {
        return $this->model
            ->where('kewenangan_id', '=', $kewenangan_id)
            ->get();
    }
}
